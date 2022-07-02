<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateEmployee extends Component
{
    use LivewireAlert;
    public $openModalCandidato = false;
    public $firstname, $lastname;

    public $rules = [
        'firstname' => ['required'],
        'lastname' => ['required']
    ];

    protected $validationAttributes = [
        'firstname' => 'nombre',
        'lastname' => 'apellido'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetFields()
    {
        $this->reset([
            'firstname',
            'lastname',
            'rules'
        ]);

        $this->resetErrorBag();
        $this->openModalCandidato = false;
        $this->resetValidation();
    }

    public function save() {
        $this->validate();

        $dataEmployee = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname
        ];

        Employee::create($dataEmployee);
        $message = 'El Candidato se registró correctamente';

        $this->resetFields();
        $this->alert('success', $message);
    }

    public function openModalCandidato() {
        $this->openModalCandidato = true;
    }

    public function render()
    {
        return view('livewire.create-employee');
    }
}
