<?php

namespace App\Livewire\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function mount()
    {
        if (! Gate::allows('viewAny', \App\Models\User::class)) {
            abort(403);
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'toolbar-right-start' => Gate::allows('create', User::class) ? [
                'components.partials.add-new-button',
                [
                    'href' => route('users.create')
                ],
            ] : null,
        ]);
    }

    public function builder(): Builder
    {
        return User::query()->with('roles');
    }

    public function columns(): array
    {
        // 1. Initialize the array of columns
        $columns = [
            Column::make("Id", "id")
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row) {

                    if (Gate::allows('impersonate', $row)) {
                        return '<a href="' . route('impersonate.start', $row) . '"
                                class="text-green-500 hover:text-green-600 no-underline">'
                            . e($value) .
                            '</a>';
                    }

                    // Not clickable
                    return '<span class="text-gray-800 dark:text-gray-200">'
                        . e($value) .
                        '</span>';
                })
                ->html(),

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),

            Column::make("Roles")
                ->label(function ($row) {
                    if ($row->roles->isEmpty()) {
                        return '<span class="text-gray-500">NO ROLE</span>';
                    }

                    return $row->roles
                        ->map(function ($role) {
                            $color = match ($role->name) {
                                'super-admin' => 'red',
                                'admin' => 'orange',
                                'manager' => 'yellow',
                                'user' => 'green',
                                default => 'gray',
                            };
                            return '<span class="inline-block px-2 py-1 rounded-full text-white text-xs font-semibold mr-1 mb-1 bg-' . $color . '-500">'
                                . strtoupper($role->name)
                                . '</span>';
                        })
                        ->implode('');
                })
                ->html()
                ->searchable(function (Builder $query, $term) {
                    $query->whereHas('roles', fn($q) => $q->where('name', 'like', "%{$term}%"));
                }),
        ];

        // 2. Conditionally append the Actions column (hides header and cells if no global permission)
        // Check if the current user has any base permission to manage users (e.g., view, update, or delete any)
        if (
            Gate::allows('viewAny', User::class) ||
            auth()->user()->can('update user') ||
            auth()->user()->can('delete user')
        ) {
            $columns[] = ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2 flex items-center', // Added flex items-center for icon alignment
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn($row) => '<i class="fas fa-eye"></i>') // Font Awesome or similar icon
                        // OR: Use a simple character if icons are complex: ->title(fn($row) => '👁️')
                        ->location(fn($row) => route('users.show', $row->id))
                        ->html() // Important: tells the column to render HTML from the title
                        ->attributes(function ($row) {
                            return [
                                // Adjusted styling for a clear, compact button (e.g., text-blue-600 for visibility)
                                'class' => 'text-blue-600 hover:text-blue-800 p-1 rounded bg-gray-100' . (!Gate::allows('view', $row)
                                    ? ' hidden' : ''),
                            ];
                        }),

                    LinkColumn::make('Edit')
                        ->title(fn($row) => '<i class="fas fa-pencil-alt"></i>')
                        ->location(fn($row) => route('users.edit', $row->id))
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
                ]);
        }

        // 3. Return the complete array
        return $columns;
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Role')
                ->options(
                    ['' => 'All'] + Role::pluck('name', 'name')->toArray()
                )
                ->filter(function (Builder $query, $value) {
                    if ($value !== '') {
                        $query->whereHas('roles', fn($q) => $q->where('name', $value));
                    }
                }),
        ];
    }

    public function delete(int $id)
    {
        $item = $this->model::find($id);

        // prevent deleting own account
        if (auth()->id() === $item->id) {
            $this->dispatch('toast-error', type: 'error', message: 'You cannot delete your own account.');
            return;
        }

        $this->authorize('delete', $item);

        $item->delete();

        $this->dispatch('toast-success', type: 'success', message: 'User deleted successfully.');
    }
}
