<?php

namespace App\Http\Livewire;

use App\Models\Evaluation;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvaluations extends Component
{
    use WithPagination;

    public $action, $selectedItem;

    protected $listeners = ['render'];

    public function selectItemEvaluation($itemId, $action)
    {
        $this->selectedItem = $itemId;
        
        if ($action == 'delete') {
            $this->deleteEvaluation();
        } else {
            $this->emitTo('create-evaluation', 'getModelIdEvaluation', $this->selectedItem);
        }
    }

    public function deleteEvaluation()
    {
        $evaluation = Evaluation::find($this->selectedItem);
        $evaluation->delete();
    }

    public function render()
    {
        $evaluations = Evaluation::orderBy('id', 'desc')->paginate(10);

        return view('livewire.show-evaluations', compact('evaluations'));
    }
}
