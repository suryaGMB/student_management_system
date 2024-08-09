<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\College;
use Livewire\Component;
use App\Models\Course;
use App\Models\CourseSelection;
use App\Models\Department;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $colleges;
    public $batches;
    public $departments;
    public $sections;
    public $courseSelections; // Add property for course selections

    public $selectedCollege;
    public $selectedBatch;
    public $selectedDepartment;
    public $selectedSection;

    // Other properties and methods...

    public function mount()
    {
        $this->colleges = College::all();
        $this->batches = Batch::all();
        $this->departments = Department::all();
        $this->sections = Section::all();
        $this->fetchCourseSelections();
    }

    public function fetchCourseSelections()
    {
        $user = Auth::user();

        // dd($user->college_id, $user->batch_id, $user->department_id, $user->section_id);


        // Fetch the user's details
        $collegeId = $user->college_id;
        $batchId = $user->batch_id;
        $departmentId = $user->department_id;
        $sectionId = $user->section_id;

             //dd($collegeId, $batchId, $departmentId, $sectionId);


        // Fetch course selections based on user's details
        $this->courseSelections = CourseSelection::with(['college', 'batch', 'department', 'section', 'course']) ->where('college_id', $collegeId)->where('batch_id', $batchId)->where('department_id', $departmentId)->where('section_id', $sectionId)->get();
            // dd($this->courseSelections);

    }

    

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
