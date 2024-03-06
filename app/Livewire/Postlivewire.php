<?php

namespace App\Livewire;

use App\Models\First;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Postlivewire extends Component
{
    use WithFileUploads;

    public $name;
    public $phoneNumber;
    public $dob;
    public $gender;
    public $address;
    public $postid;
    public $image;
    public $imagePath;
    public $created = false;
    public $updated = false;

    protected $rules = [
        'name' => 'required|string',
        'phoneNumber' => 'required|numeric',
        'dob' => 'required|date',
        'gender' => 'required|in:Male,Female,Other',
        'address' => 'required|string',
        'image' => 'required|mimes:jpg,jpeg,png',
    ];
    protected $listeners = ['editPost', 'refreshComponent' => '$refresh'];

    public function editPost($postId)
    {

        $post = First::find($postId);
        if ($post) {
            $this->postid = $postId;
            $this->name = $post->name;
            $this->phoneNumber = $post->phone_number;
            $this->dob = $post->DOB;
            $this->gender = $post->gender;
            $this->address = $post->address;
            $this->imagePath = $post->image;
        }
        $this->image = null;
    }



    public function createorupdatePost()
    {
        $rules = $this->rules;


        if (!$this->image) {
            unset($rules['image']);
        }
        // $this->validate($rules);

        $data = $this->validate($rules);


        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        if ($this->postid) {
            $post = First::find($this->postid);
            if ($this->image) {
                $postData['image'] = $this->image->store('images', 'public');

                // Delete the previous image if it exists
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    $this->deleteImage($post->image);
                }
            } else {
                // If no new image is provided, keep the previous image
                $postData['image'] = $post->image;
            }
            $post->name = $this->name;
            $post->phone_number = $this->phoneNumber;
            $post->DOB = $this->dob;
            $post->gender = $this->gender;
            $post->address = $this->address;
            $post->image = $postData['image'];
            if ($post->isDirty()) {
                $post->save();
                $this->image = null;
                session()->flash('created', 'Post created successfully!');
                $this->reset();
                $this->dispatch('refreshPosts');
            } else {
                // No changes were made
                session()->flash('error', 'No changes were made.');
            }
        } else {
            // New post creation
            First::create([
                'name' => $this->name,
                'phone_number' => $this->phoneNumber,
                'DOB' => $this->dob,
                'gender' => $this->gender,
                'address' => $this->address,
                'image' => $imagePath,
            ]);
            $this->dispatch('refreshPosts');
            $this->image = null;
            $this->created = true;
            session()->flash('created', 'Post created successfully!');
            $this->reset();
        }

        // $this->reset();
    }

    public function clearForm()
    {
        $this->reset(['name', 'phoneNumber', 'dob', 'gender', 'address', 'image']);
        $this->postid = null;
    }

    public function render()
    {
        $first = First::get();

        return view('livewire.postlivewire', compact('first'));
    }
}
