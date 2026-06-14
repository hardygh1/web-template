<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Company;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyTable extends Component
{
    use WithPagination;

    public $search = '';

    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Computed]
    public function companies()
    {
        return Company::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('legal_name', 'like', "%{$this->search}%");
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.datatables.company-table', [
            'companies' => $this->companies,
        ]);
    }
}
