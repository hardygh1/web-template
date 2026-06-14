<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Gestión de Empresas</h1>
            @can('create', App\Models\Company::class)
                <a href="{{ route('admin.companies.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>
                    Nueva Empresa
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <livewire:admin.datatables.company-table />

    </div>
</x-admin-layout>