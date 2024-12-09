<?php

namespace App\Livewire;

use App\Models\Prostoy;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProstoyTable extends DataTableComponent
{
    public $model = Prostoy::class;

    public $showSidebar = false;
    public $prostoy;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Prostoy::query()->with(['client', 'carrier', 'sales', 'operation']);
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
            Column::make('Client', 'client_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->client->name ?? 'N/A'),
            Column::make('Carrier', 'carrier_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->carrier->name ?? 'N/A'),
            // Column::make('Sales', 'sales_id')
            //     ->sortable()
            //     ->format(fn($value, $row) => $row->sales->name ?? 'N/A'),
            // Column::make('Operation', 'operation_id')
            //     ->sortable()
            //     ->format(fn($value, $row) => $row->operation->name ?? 'N/A'),
            Column::make('Client Amount', 'client_amount')
                ->sortable()
                ->searchable(),
            Column::make('Carrier Amount', 'carrier_amount')
                ->sortable()
                ->searchable(),
            Column::make('Carrier Currency', 'carrier_currency')
                ->sortable(),
            Column::make('Actions')
                ->label(fn($row) => view('livewire.prostoy.actions', ['row' => $row])),
        ];
    }


    public function delete(Prostoy $prostoy)
    {
        $prostoy->delete();
        $this->listeners['refreshDatatable'];
    }
    public function sendToChild($prostoy)
    {
        $this->dispatch('edit', ['prostoy' => $prostoy])->to('create-prostoy');

    }
}
