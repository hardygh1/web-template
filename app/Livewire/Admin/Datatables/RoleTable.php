<?php

namespace App\Livewire\Admin\Datatables;

use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class RoleTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function roles()
    {
        return Role::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.datatables.role-table', [
            'roles' => $this->roles,
        ]);
    }
}
