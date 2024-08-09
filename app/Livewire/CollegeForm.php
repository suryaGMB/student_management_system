<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\College;


class CollegeForm extends Component
{
    public $name;
    public $editedName;
    public $editId;
    public $colleges;

    public function mount()
    {
        $this->colleges = College::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        College::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->colleges = College::all();
    }

    public function edit($collegeId)
    {
        $this->editId = $collegeId;
        $this->editedName = College::find($collegeId)->name;
    }

    public function update($collegeId)
    {
        $college = College::find($collegeId);
        $college->name = $this->editedName;
        $college->save();
        $this->editId = null;
        $this->colleges = College::all(); 
    }

    public function delete($collegeId)
    {
        College::destroy($collegeId);
        $this->colleges = College::all(); 
    }

    public function render()
    {
        return view('livewire.college-form');
    }
}
