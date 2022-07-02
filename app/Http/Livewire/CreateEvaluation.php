<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Support\Arr;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateEvaluation extends Component
{
    use LivewireAlert;

    public $openModal = false;
    public $datefrom, $dateto, $employee_id, $modelId,
            $categoriesBoolean, $categoriesInteger,
            $action = "Registrar";

    protected $listeners = ['getModelIdEvaluation'];

    public function getModelIdEvaluation($modelId)
    {
        $this->modelId = $modelId;

        $evaluation = Evaluation::find($this->modelId);
        $this->datefrom = $evaluation->datefrom;
        $this->dateto = $evaluation->dateto;
        $this->employee_id = $evaluation->employee_id;

        $this->categoriesBoolean = $evaluation->categories()->whereNull('goalinteger')->orderBy('id', 'asc')->get();
        foreach($this->categoriesBoolean as $item) {
            $item = Arr::set($item, 'valueboolean', $item->pivot->valueboolean != null ? 1 : 0);
        }

        $this->categoriesInteger = $evaluation->categories()->whereNull('goalboolean')->orderBy('id', 'asc')->get();
        foreach($this->categoriesInteger as $item) {
            $item = Arr::set($item, 'valueinteger', $item->pivot->valueinteger != null ? $item->pivot->valueinteger : 0);
        }

        $this->action = "Editar";
        $this->openModal();
    }

    public function mount()
    {
        $this->categoriesInteger = Category::whereNull('goalboolean')->orderBy('id', 'asc')->get();
        $this->addCategoriesInteger($this->categoriesInteger);

        $this->categoriesBoolean = Category::whereNull('goalinteger')->orderBy('id', 'asc')->get();
        $this->addCategoriesBoolean($this->categoriesBoolean);
    }

    public function addCategoriesInteger($categoriesInteger){
        foreach($categoriesInteger as $item) {
            $item = Arr::set($item, 'valueinteger', $item->valueinteger != null ? $item->valueinteger : 0);
        }
    }

    public function addCategoriesBoolean($categoriesBoolean){
        foreach($categoriesBoolean as $item) {
            $item = Arr::set($item, 'valueboolean', $item->valueboolean != null ? 1 : 0);
        }
    }
    
    public $rules = [
        'datefrom' => ['required', 'date'],
        'dateto' => ['required', 'date', 'after:datefrom'],
        'employee_id' => ['required'],
        'categoriesBoolean.*.valueboolean' => ['boolean'],
        'categoriesInteger.*.valueinteger' => ['min:0','integer']
    ];

    protected $validationAttributes = [
        'datefrom' => 'fecha desde',
        'dateto' => 'fecha hasta',
        'employee_id' => 'empleado'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetFields()
    {
        $this->reset([
            'datefrom',
            'dateto',
            'employee_id',
            'modelId',
            'action',
            'rules'
        ]);

        $this->resetErrorBag();
        $this->openModal = false;
        $this->resetValidation();
    }

    public function save() {
        $this->validate();

        $dataEvaluation = [
            'datefrom' => $this->datefrom,
            'dateto' => $this->dateto,
            'employee_id' => $this->employee_id,
        ];

        $score = 0;
        $bonus = 0;

        if ($this->modelId) {

            Evaluation::find($this->modelId)->update($dataEvaluation);
            $evaluation = Evaluation::find($this->modelId);
            
            foreach ($this->categoriesBoolean as $item) {
                $evaluation->categories()->updateExistingPivot($item->id,['valueboolean' => $item->valueboolean]);
                $item->valueboolean == $item->goalboolean ? $score += $item->score : $score += 0;
            }

            foreach ($this->categoriesInteger as $item) {
                $evaluation->categories()->updateExistingPivot($item->id,['valueinteger' => $item->valueinteger]);
                $item->valueinteger <= $item->goalinteger ? $score += $item->score : $score += 0;
            }

            $score <= 25 && $score >= 20 ? $bonus += round(($score/25)*10, 2) : $bonus += 0;

            $data = [
                'score' => $score,
                'bonus' => $bonus
            ];

            Evaluation::find($evaluation->id)->update($data);

            $message = 'La evaluacion se actualizó correctamente';

        } else {
            $evaluation = Evaluation::create($dataEvaluation);
            $evaluationLatest = Evaluation::find($evaluation->id);

            $this->addCategoriesInteger($this->categoriesInteger);
            $this->addCategoriesBoolean($this->categoriesBoolean);

            foreach ($this->categoriesBoolean as $item) {
                $evaluationLatest->categories()->attach($item->id,['valueboolean' => $item->valueboolean]);
                $item->valueboolean == $item->goalboolean ? $score += $item->score : $score += 0;
            }

            foreach ($this->categoriesInteger as $item) {
                $evaluationLatest->categories()->attach($item->id,['valueinteger' => $item->valueinteger]);
                $item->valueinteger <= $item->goalinteger ? $score += $item->score : $score += 0;
            }

            $score <= 25 && $score >= 20 ? $bonus += round(($score/25)*10, 2) : $bonus += 0;

            $data = [
                'score' => $score,
                'bonus' => $bonus
            ];

            Evaluation::find($evaluation->id)->update($data);

            $message = 'La evaluacion se registró correctamente';
        }

        $this->resetFields();
        $this->alert('success', $message);
        $this->emitTo('show-evaluations','render');

    }

    public function openModal() {
        $this->openModal = true;
    }

    public function render()
    {
        $employees = Employee::all();

        return view('livewire.create-evaluation', compact('employees'));
    }
}
