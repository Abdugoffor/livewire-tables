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
        $this->setConfigurableAreas([
            'toolbar-right-start' => ['livewire.prostoy.add'],
        ]);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить выбранные',
            'exportSelected' => 'Экспорт выбранные',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('ID заказа', 'order_id')
                ->sortable()
                ->searchable(),
            Column::make('Поставщик', 'supplier_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->supplier->name ?? 'N/A'),
            Column::make('Причина', 'reason_id')
                ->sortable()
                ->format(fn($value, $row) => $row->reason->name ?? 'N/A'),
            Column::make('Валюта', 'currency')
                ->sortable()
                ->searchable(),
            Column::make('Сумма', 'amount')
                ->sortable()
                ->searchable(),
            Column::make('Действия')
                ->label(fn($row) => view('livewire.prostoy.actions', ['row' => $row])),
        ];
    }
    public function deleteSelected()
    {
        $ids = $this->getSelected();
        OtherExpense::whereIn('id', $ids)->delete();
        $this->listeners['refreshDatatable'];
    }
    public function exportSelected()
    {
        $ids = $this->getSelected();

        $data = OtherExpense::whereIn('id', $ids)->get()->toArray();

        $filename = 'export_' . now()->format('Y_m_d_His') . '.csv';

        $handle = fopen($filename, 'w');
        fputcsv($handle, array_keys($data[0] ?? []));

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        $this->clearSelected();

        return response()->download($filename)->deleteFileAfterSend();
    }
    public function sendToChild($expense)
    {
        $this->dispatch('edit', ['expense' => $expense])->to('create-othe-expense');

    }
    public function add()
    {
        $this->dispatch('createForm')->to('create-othe-expense');
    }
}
