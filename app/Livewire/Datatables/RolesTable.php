<?php

namespace App\Livewire\Datatables;

use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Spatie\Permission\Models\Role;

class RolesTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'toolbar-right-start' => [
                'components.partials.add-new-button',
                [
                    'href' => route('roles.create')
                ],
            ],
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '<i class="fas fa-pencil-alt"></i>')
                        ->location(fn($row) => route('roles.edit', $row->id))
                        ->html()
                        ->attributes(function ($row) {
                            return [
                                'class' => 'text-indigo-600 hover:text-indigo-800 p-1 rounded bg-gray-100' . (!Gate::allows('update', $row)
                                    ? ' hidden' : ''),
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '<i class="fas fa-trash"></i>')
                        ->location(fn($row) => "#")
                        ->html()
                        ->attributes(function ($row) {
                            return [
                                "wire:click" => "delete($row->id)",
                                "wire:confirm" => "Are you sure you want to delete this package?",
                                'class' => 'text-red-600 hover:text-red-800 p-1 rounded bg-gray-100' . (!Gate::allows('delete', $row)
                                    ? ' hidden' : ''),
                            ];
                        }),
                ]),
        ];
    }

    public function delete(int $id)
    {
        $role = $this->model::find($id);

        if (!$role) {
            return;
        }

        if (!Gate::allows('delete', $role) || $role->id == 1) {
            $this->dispatch('toast-error', type: 'error', message: 'You cannot delete this role.');
            return;
        }

        $role->delete();

        $this->dispatch('toast-success', type: 'success', message: 'Role deleted successfully.');
    }
}
