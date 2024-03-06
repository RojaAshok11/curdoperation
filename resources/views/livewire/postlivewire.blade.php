<div>
    <form wire:submit.prevent="createorupdatePost" class="">
        <div>
            <label for="name" class="p-4 pe-5">Name:</label>
            <input wire:model="name" type="text" id="name">
            @error('name') <span class="text-danger">   </span> @enderror
        </div>

        <div>
            <label for="phoneNumber" class="p-1">Phone Number:</label>
            <input wire:model="phoneNumber" type="text" id="phoneNumber">
            @error('phoneNumber') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="dob"  class="p-4 ps-4 pe-5">DOB:</label>
            <input wire:model="dob" type="date" id="dob">
            @error('dob') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="gender" class="p-3 pe-4">Gender:</label>
            <select wire:model="gender" id="gender">
                <option value="Select">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="address" class="p-3 pe-5">Address:</label>
            <textarea wire:model="address" id="address"></textarea>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image" class="p-3 pe-5">Image:</label>
            <input wire:model.prevent="image" type="file" id="image">

            @if ($imagePath)
                <p>Previous Image:</p>
                <img src="{{ asset('storage/' . $imagePath) }}" alt="Previous Image" style="max-width: 100px;">
            @endif

            @if ($postid && !$imagePath && !$image)
                <p>No Image</p>
            @endif
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div>
            <button type="submit"class="m-4">{{$postid ? 'Update' : 'Create'}} </button>
            <button type="button" wire:click="clearForm" class="m-4">Clear</button>
        </div>
    </form>



    @if(session()->has('created'))
        <div class="alert alert-success alert-dismissible fade show">
            <p>{{ session('created') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('updated'))
        <div class="alert alert-success">
            <p>{{ session('updated') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


</div>
