<?php

namespace App\Livewire;

use App\Models\College;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Department;
use App\Models\Section;
use App\Models\CourseSelection;

use Livewire\Component;

class CourseSelectionForm extends Component
{
    public $selectedCollege;
    public $selectedBatch;
    public $selectedDepartment;
    public $selectedSection;
    public $selectedCourse; 

    public $course_selections;

    public $colleges;
    public $batches;
    public $departments;
    public $sections;
    public $courses;

    public function mount()
    {
        $this->colleges = College::all();
        $this->batches = Batch::all();
        $this->departments = Department::all();
        $this->sections = Section::all();
        $this->courses = Course::all();
        $this->fetchCourseSelection();
    }

    public function fetchCourseSelection()
    {
        $this->course_selections = CourseSelection::with('college:id,name', 'batch:id,name', 'department:id,name', 'section:id,name')->get();
    }
    
    public function saveSelection()
    {
        CourseSelection::create([
            'college_id' => $this->selectedCollege,
            'batch_id' => $this->selectedBatch,
            'department_id' => $this->selectedDepartment,
            'section_id' => $this->selectedSection,
            'course_id' => $this->selectedCourse,
        ]);

        $this->fetchCourseSelection();

        // Reset the selections after saving
        $this->reset(['selectedCollege', 'selectedBatch', 'selectedDepartment', 'selectedSection', 'selectedCourse']);
    }

    public function deleteSelection($selectionId)
{
    $selection = CourseSelection::find($selectionId);
    if ($selection) {
        $selection->delete();
        $this->fetchCourseSelection(); // Fetch updated course selections after deletion
    }
}

    public function render()
    {
        return view('livewire.course-selection-form');
    }
}
