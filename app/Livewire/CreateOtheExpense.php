<?php

namespace App\Livewire;

use App\Models\OtherExpense;
use App\Models\Reason;
use App\Models\Supplier;
use Livewire\Component;

class CreateOtheExpense extends Component
{
    public $suppliers, $reasons, $supplier_id, $reason_id, $amount, $currency, $order_id, $id;
    public $activeForm = false;
    protected $listeners = ['edit'];
    protected $rules = [
        'order_id' => 'required|integer',
        'supplier_id' => 'required|integer|exists:suppliers,id',
        'reason_id' => 'required|integer|exists:reasons,id',
        'amount' => 'required|numeric',
        'currency' => 'required|string',
    ];
    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->reasons = Reason::all();
    }
    public function render()
    {
        return view('livewire.create-othe-expense');
    }
    public function createExpense()
    {
        $this->activeForm = !$this->activeForm;
    }
    public function save()
    {
        $this->validate();
        OtherExpense::updateOrCreate(
            ['id' => $this->id],
            [
                'order_id' => $this->order_id,
                'supplier_id' => $this->supplier_id,
                'reason_id' => $this->reason_id,
                'amount' => $this->amount,
                'currency' => $this->currency,
            ]
        );
        $this->resetForm();
        $this->activeForm = false;
        $this->dispatch('othe-expense-table');
    }
    public function resetForm()
    {
        $this->createExpense();
        $this->reset([
            'id', 'order_id', 'supplier_id', 'reason_id', 'amount', 'currency',
        ]);
    }
    public function edit(OtherExpense $expense)
    {
        $this->id = $expense->id;
        $this->order_id = $expense->order_id;
        $this->supplier_id = $expense->supplier_id;
        $this->reason_id = $expense->reason_id;
        $this->amount = $expense->amount;
        $this->currency = $expense->currency;
        $this->activeForm = true;
    }
}
