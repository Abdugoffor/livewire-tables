<?php

namespace App\Livewire;

use App\Models\OtherExpense;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OtheExpenseTable extends DataTableComponent
{
    public $model = OtherExpense::class;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return OtherExpense::query()->with(['supplier', 'reason']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setPaginationEnabled(true)
            ->setSearchEnabled(true);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Order ID', 'order_id')
                ->sortable()
                ->searchable(),
            Column::make('Supplier ID', 'supplier_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->supplier->name ?? 'N/A'),
            Column::make('Reason ID', 'reason_id')
                ->sortable()
                ->format(fn($value, $row) => $row->reason->name ?? 'N/A'),
            Column::make('Currency', 'currency')
                ->sortable()
                ->searchable(),
            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->label(fn($row) => view('livewire.prostoy.actions', ['row' => $row])),
        ];
    }
    public function sendToChild($expense)
    {
        $this->dispatch('edit', ['expense' => $expense])->to('create-othe-expense');

    }
}
