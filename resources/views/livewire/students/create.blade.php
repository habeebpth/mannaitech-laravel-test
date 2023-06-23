<form enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name" wire:model="name">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="grade">Grade</label>
        <input type="text" class="form-control" id="grade" placeholder="Enter Name" wire:model="grade">
        @error('grade')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" class="form-control" id="department" placeholder="Enter Name" wire:model="department">
        @error('department')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" wire:model="image" class="form-control" id="image">
        @error('image') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button wire:click.prevent="store()" class="btn btn-primary mt-2">Save</button>
</form>
