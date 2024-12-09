<?php

namespace App\Livewire;

use App\Models\Prostoy;
use Livewire\Component;

class CreateProstoy extends Component
{
    public $prostoyForm = false;
    public $order_id, $client_id, $carrier_id, $sales_id, $operation_id;
    public $carrier_amount, $carrier_currency, $client_amount, $client_currency, $id;
    public $users;

    public function mount()
    {
        $this->users = \App\Models\User::all();
    }

    protected $listeners = ['edit'];

    protected $rules = [
        'order_id' => 'required|integer',
        'client_id' => 'required|integer|exists:users,id',
        'carrier_id' => 'required|integer|exists:users,id',
        'sales_id' => 'nullable|integer|exists:users,id',
        'operation_id' => 'nullable|integer|exists:users,id',
        'carrier_amount' => 'required|numeric',
        'carrier_currency' => 'required|string|max:3',
        'client_amount' => 'required|numeric',
        'client_currency' => 'required|string|max:3',
    ];
    public function render()
    {
        return view('livewire.create-prostoy');
    }
    public function createProstoy()
    {
        $this->prostoyForm = !$this->prostoyForm;
    }
    public function save()
    {
        $this->validate();
        Prostoy::updateOrCreate(
            ['id' => $this->id],
            [
                'order_id' => $this->order_id,
                'client_id' => $this->client_id,
                'carrier_id' => $this->carrier_id,
                'sales_id' => $this->sales_id,
                'operation_id' => $this->operation_id,
                'carrier_amount' => $this->carrier_amount,
                'carrier_currency' => $this->carrier_currency,
                'client_amount' => $this->client_amount,
                'client_currency' => $this->client_currency,
            ]
        );

        $this->resetForm();
        $this->prostoyForm = false;
        $this->dispatch('prostoy-table');
    }
    public function edit(Prostoy $prostoy)
    {
        $this->id = $prostoy->id;
        $this->order_id = $prostoy->order_id;
        $this->client_id = $prostoy->client_id;
        $this->carrier_id = $prostoy->carrier_id;
        $this->sales_id = $prostoy->sales_id;
        $this->operation_id = $prostoy->operation_id;
        $this->carrier_amount = $prostoy->carrier_amount;
        $this->carrier_currency = $prostoy->carrier_currency;
        $this->client_amount = $prostoy->client_amount;
        $this->client_currency = $prostoy->client_currency;

        $this->prostoyForm = true;
    }

    public function resetForm()
    {
        $this->createProstoy();

        $this->reset([
            'id', 'order_id', 'client_id', 'carrier_id', 'sales_id',
            'operation_id', 'carrier_amount', 'carrier_currency',
            'client_amount', 'client_currency',
        ]);
    }
}
