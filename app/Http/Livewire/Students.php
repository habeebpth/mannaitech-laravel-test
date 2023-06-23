<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;

class Students extends Component
{
    use WithFileUploads;
    public $students, $name, $grade, $department, $image, $student_id;
    public $updateMode = false;

    public function render()
    {
        $this->students = Student::all();
        return view('livewire.students.index');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->grade = '';
        $this->department = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'grade' => 'required',
            'department' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($this->image) {
            $imagePath = $this->image->store('students', 'public'); // Store the uploaded photo

            $validatedDate['image'] = $imagePath;
        }

        Student::create($validatedDate);

        session()->flash('message', 'Student Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = Student::where('id', $id)->first();
        $this->student_id = $id;
        $this->name = $user->name;
        $this->grade = $user->grade;
        $this->department = $user->department;
        $this->image = $user->image;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'grade' => 'required',
            'department' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($this->student_id) {
            $user = Student::find($this->student_id);
            if ($this->image) {
                $imagePath = $this->image->store('students', 'public'); // Store the uploaded photo
                $validatedData['image'] = $imagePath;
            }
            $user->update($validatedDate);
            $this->updateMode = false;
            session()->flash('message', 'Student Updated Successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        if ($id) {
            Student::where('id', $id)->delete();
            session()->flash('message', 'Student Deleted Successfully.');
        }
    }
}
