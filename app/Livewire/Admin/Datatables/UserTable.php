<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class UserTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function users()
    {
        $authUser = Auth::user();

        return User::query()
            ->where('company_id', $authUser->company_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.datatables.user-table', [
            'users' => $this->users,
        ]);
    }
}
