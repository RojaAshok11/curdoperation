<?php

// app/Livewire/Postlistlivewire.php

namespace App\Livewire;

use Storage;
use App\Models\First;
use Livewire\Component;
use Livewire\WithFileUploads;


class Postlistlivewire extends Component
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
    public $postIdToDelete;
    public $showDeleteConfirmation = false;


    protected $listeners = ['refreshPosts'];


    public function edit($postId)
    {
        $this->dispatch('editPost',$postId)->to(Postlivewire::class);

    }
    public function deletePost($postId)
{
    $this->postIdToDelete = $postId;
    $this->showDeleteConfirmation = true;

}

public function confirmDelete()
{
    $post = First::find($this->postIdToDelete);
    if ($post) {
        if ($post->image) {
            $this->deleteImage($post->image);
        }
        $post->delete();
    }
    $this->showDeleteConfirmation = false;
    session()->flash('success', 'Post deleted successfully.');
    $this->dispatch('refreshPosts');

}




    private function deleteImage($imagePath)
    {
        Storage::disk('public')->delete($imagePath);
    }

    public function refreshPosts()
    {
        $this->render(); // Refresh the posts after a post is updated
    }
    public function render()
    {
        $first = First::get();
        // $first = First::withTrashed()->get();//include softdelete

        return view('livewire.postlistlivewire', compact('first'));
    }

}

