<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseForm extends Component
{

    public $name;
    public $editedName;
    public $editId;
    public $courses;

    public function mount()
    {
        $this->courses = Course::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Course::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->courses = Course::all();
    }

    public function edit($courseId)
    {
        $this->editId = $courseId;
        $this->editedName = Course::find($courseId)->name;
    }

    public function update($courseId)
    {
        $course = Course::find($courseId);
        $course->name = $this->editedName;
        $course->save();
        $this->editId = null;
        $this->courses = Course::all(); 
    }

    public function delete($courseId)
    {
        Course::destroy($courseId);
        $this->courses = Course::all(); 
    }

    public function render()
    {
        return view('livewire.course-form');
    }
}
