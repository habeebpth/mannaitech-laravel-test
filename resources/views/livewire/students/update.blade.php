<form>
    <div class="form-group">
        <input type="hidden" wire:model="student_id">
        <label for="name">Name</label>
        <input type="text" class="form-control" wire:model="name" id="name" placeholder="Enter Name">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="grade">Grade</label>
        <input type="text" class="form-control" wire:model="grade" id="grade" placeholder="Enter Grade">
        @error('grade') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="department">Department</label>
        <input type="text" class="form-control" wire:model="department" id="department" placeholder="Enter Department">
        @error('department') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-primary mt-2">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger mt-2">Cancel</button>
</form>
