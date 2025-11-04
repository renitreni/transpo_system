<?php

namespace App\Livewire;

use App\Models\Maintenance;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class MaintenanceTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'MaintenanceTable';

    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot('<i class="fa-regular fa-file-excel text-lg"></i>')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('export-xlsx', [])
                ->target('_blank'),
        ];
    }

    public function datasource(): Builder
    {
        return Maintenance::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Brand name', 'brand_name')
                ->sortable()
                ->searchable(),

            Column::make('Vin no', 'vin_no')
                ->sortable()
                ->searchable(),

            Column::make('Warranty', 'warranty')
                ->sortable()
                ->searchable(),

            Column::make('Kilometers', 'kilometers')
                ->sortable()
                ->searchable(),

            Column::make('Hour', 'hour')
                ->sortable()
                ->searchable(),

            Column::make('Company cr', 'company_cr')
                ->sortable()
                ->searchable(),

            Column::make('Contact person', 'contact_person')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('$dispatch(\'open-modal\',\'add-new-maintenance\')');

        $this->dispatch('fetch-maintenance', id: $rowId);
    }

    public function actions(Maintenance $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
