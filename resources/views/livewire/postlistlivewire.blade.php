

<div>
    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($first)
        <table class="table table-bordered table table-success table-striped">

            <tr class="">
                <th>Name</th>
                <th>Phone Number</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            @foreach($first as $eachfirstdata)
            <tr>
                <td class=" ">
                    {{$eachfirstdata->name}}
                </td>
                <td>
                    {{$eachfirstdata->phone_number}}
                </td>
                <td>
                    {{$eachfirstdata->DOB}}
                </td><td>
                    {{$eachfirstdata->gender}}
                </td>
                <td>
                    {{$eachfirstdata->address}}
                </td>
                <td>
                    @if($eachfirstdata->image)
                        <img src="{{ asset('storage/' . $eachfirstdata->image) }}" alt="Image" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <button wire:click.prevent="edit({{ $eachfirstdata->id }})">Edit</button>

                    {{-- <button wire:click.prevent="deletePost({{ $eachfirstdata->id }})">Delete</button> --}}
                    <button wire:click.prevent="deletePost({{ $eachfirstdata->id }})">Delete</button>

                    @if($showDeleteConfirmation && $postIdToDelete == $eachfirstdata->id)
                    <div  class="position-absolute top-50 start-50  bg-primary p-3" >
                        <p>Are you sure you want to delete this  post?</p>
                        <button wire:click="confirmDelete">Yes</button>
                        <button wire:click="$set('showDeleteConfirmation', false)">No</button>
                    </div>
                @endif
                </td>
            </tr>

            @endforeach
        </table>
        @endif


    </div>

</div>
