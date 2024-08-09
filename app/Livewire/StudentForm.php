<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\College;
use Livewire\WithFileUploads;
use App\Models\Batch;
use App\Models\Department;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Models\User; // Import the User model





class StudentForm extends Component
{
    use WithFileUploads; // Add the WithFileUploads trait

    public $colleges;
    public $batches;
    public $departments;
    public $sections;
    public $users; // Add a property to store the users

    public $selectedCollege;
    public $selectedBatch;
    public $selectedDepartment;
    public $selectedSection;

    public $excelFile;

    

    public $searchCollege;
    public $searchBatch;
    public $searchDepartment;
    public $searchSection;


    public function mount()
    {
        $this->colleges = College::all();
        $this->batches = Batch::all();
        $this->departments = Department::all();
        $this->sections = Section::all();
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $this->users = User::with('college:id,name')->where('user_type', 'users')->get();
        $this->users = User::with('batch:id,name')->where('user_type', 'users')->get();
        $this->users = User::with('department:id,name')->where('user_type', 'users')->get();
        $this->users = User::with('section:id,name')->where('user_type', 'users')->get();
    }


    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function handleFileUpload()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls|max:10240',
            'selectedCollege' => 'required',
            'selectedBatch' => 'required',
            'selectedDepartment' => 'required',
            'selectedSection' => 'required',
        ]);

        // Store the uploaded file
        $path = $this->excelFile->store('uploads');
        // Import the data from the Excel file and pass the selected college ID
        Excel::import(new UserImport($this->selectedCollege, $this->selectedBatch, $this->selectedDepartment, $this->selectedSection), storage_path('app/' . $path));
        session()->flash('message', 'File uploaded successfully!');
        // After uploading the file, fetch users again
        $this->fetchUsers();
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->fetchUsers(); // Fetch updated users after deletion
        }
    }

    public function filterUsers()
    {
        $query = User::with('college:id,name', 'batch:id,name', 'department:id,name', 'section:id,name')
            ->where('user_type', 'users');

        if (!empty($this->searchCollege)) {
            $query->whereHas('college', function ($q) {
                $q->where('name', $this->searchCollege);
            });
        }

        if (!empty($this->searchBatch)) {
            $query->whereHas('batch', function ($q) {
                $q->where('name', $this->searchBatch);
            });
        }

        if (!empty($this->searchDepartment)) {
            $query->whereHas('department', function ($q) {
                $q->where('name', $this->searchDepartment);
            });
        }

        if (!empty($this->searchSection)) {
            $query->whereHas('section', function ($q) {
                $q->where('name', $this->searchSection);
            });
        }

        $this->users = $query->get();
    }



    public function render()
    {

        return view('livewire.student-form');
    }
}
