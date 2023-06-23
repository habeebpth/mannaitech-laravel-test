<div>
    <div class="row">
        <div class="col-md-4">
            @if ($updateMode)
                @include('livewire.students.update')
            @else
                @include('livewire.students.create')
            @endif
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Grade</th>
                        <th>Department</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->grade }}</td>
                            <td>{{ $value->department }}</td>
                            <td><img src="{{url('storage/')}}/{{$value->image}}" width="100"></td>
                            <td>
                                <button wire:click="edit({{ $value->id }})"
                                    class="btn btn-primary btn-sm">Edit</button>
                                <button wire:click="delete({{ $value->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
