<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;

class DepartmentForm extends Component
{
    public $name;
    public $editedName;
    public $editId;
    public $departments;

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->departments = Department::all();
    }

    public function edit($departmentId)
    {
        $this->editId = $departmentId;
        $this->editedName = Department::find($departmentId)->name;
    }

    public function update($departmentId)
    {
        $department = Department::find($departmentId);
        $department->name = $this->editedName;
        $department->save();
        $this->editId = null;
        $this->departments = Department::all(); // Fetch departments again after updating
    }

    public function delete($departmentId)
    {
        Department::destroy($departmentId);
        $this->departments = Department::all(); // Fetch departments again after deleting
    }


    public function render()
    {
        return view('livewire.department-form');
    }
}
