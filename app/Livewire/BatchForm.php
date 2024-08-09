<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch;

class BatchForm extends Component
{
    public $name;
    public $editedName;
    public $editId;
    public $batches;

    public function mount()
    {
        $this->batches = Batch::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Batch::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->batches = Batch::all();
    }

    public function edit($batchId)
    {
        $this->editId = $batchId;
        $this->editedName = Batch::find($batchId)->name;
    }

    public function update($batchId)
    {
        $batch = Batch::find($batchId);
        $batch->name = $this->editedName;
        $batch->save();
        $this->editId = null;
        $this->batches = Batch::all(); // Fetch batches again after updating
    }

    public function delete($batchId)
    {
        Batch::destroy($batchId);
        $this->batches = Batch::all(); // Fetch batches again after deleting
    }


    public function render()
    {
        return view('livewire.batch-form');
    }
}
