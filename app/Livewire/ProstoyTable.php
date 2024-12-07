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
                ->searchable(),
            Column::make('Client Amount', 'client_amount')
                ->sortable()
                ->searchable(),
            Column::make('Carrier Amount', 'carrier_amount')
                ->sortable()
                ->searchable(),
            Column::make('Currency', 'carrier_currency')
                ->sortable(),
            Column::make('Actions')
                ->label(fn($row) => view('livewire.prostoy.actions', ['row' => $row])),
        ];
    }

    public function openSidebar($id = null)
    {
        $this->prostoy = $id ? Prostoy::findOrFail($id) : new Prostoy();
        $this->showSidebar = true;
    }

    public function closeSidebar()
    {
        $this->showSidebar = false;
    }

    public function save()
    {
        $this->prostoy->save();
        $this->showSidebar = false;
        $this->emit('refreshDatatable');
    }

    public function delete($id)
    {
        Prostoy::findOrFail($id)->delete();
        $this->emit('refreshDatatable');
    }
}
