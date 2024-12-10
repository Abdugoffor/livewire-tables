<?php

namespace App\Livewire;

use App\Models\Prostoy;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use WireUi\Traits\WireUiActions;

class ProstoyTable extends DataTableComponent
{
    use WireUiActions;
    public $model = Prostoy::class;

    public $prostoyForm = false;
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
        $this->setConfigurableAreas([
            'toolbar-right-start' => ['livewire.prostoy.add'],
        ]);
        $this->setBulkActions([
            'deleteSelected' => 'Удалить выбранные',
            'exportSelected' => 'Экспорт выбранные',
        ]);
        // $this->setBulkActionsCustomLabel('Выбрать действия');

    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Клиент', 'client_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->client->name ?? 'N/A'),
            Column::make('Перевозчик', 'carrier_id')
                ->sortable()
                ->searchable()
                ->format(fn($value, $row) => $row->carrier->name ?? 'N/A'),
            // Column::make('Sales', 'sales_id')
            //     ->sortable()
            //     ->format(fn($value, $row) => $row->sales->name ?? 'N/A'),
            // Column::make('Operation', 'operation_id')
            //     ->sortable()
            //     ->format(fn($value, $row) => $row->operation->name ?? 'N/A'),
            Column::make('Сумма клиента', 'client_amount')
                ->sortable()
                ->searchable(),
            Column::make('Сумма перевозчика', 'carrier_amount')
                ->sortable()
                ->searchable(),
            Column::make('Валюта', 'carrier_currency')
                ->sortable(),
            Column::make('Действия')
                ->label(fn($row) => view('livewire.prostoy.actions', ['row' => $row])),
        ];
    }
    public function filters(): array
    {
        return [
            SelectFilter::make('Показать удаленные')
                ->options([
                    '' => 'Нет', // Faqat mavjud yozuvlar
                    '1' => 'Да', // O‘chirilgan yozuvlarni ko‘rsatish
                ])
                ->filter(function ($query, $value) {
                    if ($value === '1') {
                        $query->withTrashed();
                    }
                }),
        ];
    }
    public function deleteSelected()
    {
        $ids = $this->getSelected();

        Prostoy::whereIn('id', $ids)->delete();

        $this->notification()->confirm([
            'title' => 'Вы уверены?',
            'description' => 'Вы хотите восстановить удаленные записи?',
            'icon' => 'question',
            'accept' => [
                'label' => 'Да, восстановить',
                'method' => 'restoreDeleted',
                'params' => json_encode($ids),
            ],
            'reject' => [
                'label' => 'Нет, отменить',
            ],
        ]);

        $this->listeners['refreshDatatable'];
        $this->clearSelected();

    }
    public function restoreDeleted($ids)
    {
        $ids = json_decode($ids, true);

        Prostoy::withTrashed()->whereIn('id', $ids)->restore();

        $this->notification()->success(

            $title = 'Записи восстановлены!',

            $description = 'Выбранные записи были успешно восстановлены.'

        );
    }
    public function exportSelected()
    {
        $ids = $this->getSelected();

        $data = Prostoy::whereIn('id', $ids)->get()->toArray();

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

    public function delete(Prostoy $prostoy)
    {
        $prostoy->delete();
        $this->listeners['refreshDatatable'];
    }
    public function sendToChild($prostoy)
    {
        $this->dispatch('edit', ['prostoy' => $prostoy])->to('create-prostoy');
        $this->listeners['refreshDatatable'];

    }
    public function add()
    {
        $this->dispatch('createForm')->to('create-prostoy');
        $this->listeners['refreshDatatable'];
    }
}
