<x-admin-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
            <div class="flex gap-3">
                @can('update', $company)
                    <a href="{{ route('admin.companies.edit', $company) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                @endcan
                @can('delete', $company)
                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" style="display: inline;"
                        onsubmit="return confirm('¿Está seguro de que desea eliminar esta empresa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Información General</h2>
            </div>

            <div class="px-6 py-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nombre</h3>
                        <p class="text-lg text-gray-900">{{ $company->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="text-lg text-gray-900">{{ $company->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Razón Social</h3>
                        <p class="text-lg text-gray-900">{{ $company->legal_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Teléfono</h3>
                        <p class="text-lg text-gray-900">{{ $company->phone ?? 'N/A' }}</p>
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                        <p class="text-lg text-gray-900">{{ $company->description ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                        <span
                            class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            @if ($company->status === 'active') bg-green-100 text-green-800
                            @elseif($company->status === 'inactive') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800 @endif">
                            @if ($company->status === 'active')
                                Activo
                            @elseif($company->status === 'inactive')
                                Inactivo
                            @else
                                Suspendido
                            @endif
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Fecha de Creación</h3>
                        <p class="text-lg text-gray-900">{{ $company->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.companies.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>

    </div>
</x-admin-layout>