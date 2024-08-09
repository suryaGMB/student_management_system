<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Section;

class SectionForm extends Component
{

    public $name;
    public $editedName;
    public $editId;
    public $sections;

    public function mount()
    {
        $this->sections = Section::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Section::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->sections = Section::all();
    }

    public function edit($sectionId)
    {
        $this->editId = $sectionId;
        $this->editedName = Section::find($sectionId)->name;
    }

    public function update($sectionId)
    {
        $section = Section::find($sectionId);
        $section->name = $this->editedName;
        $section->save();
        $this->editId = null;
        $this->sections = Section::all(); // Fetch sections again after updating
    }

    public function delete($sectionId)
    {
        Section::destroy($sectionId);
        $this->sections = Section::all(); // Fetch sections again after deleting
    }


    public function render()
    {
        return view('livewire.section-form');
    }
}
