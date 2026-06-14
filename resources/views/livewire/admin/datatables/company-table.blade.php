<div class="bg-white rounded-lg shadow">

    <div class="p-4 border-b">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar empresas..."
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Estado</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($companies as $company)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm font-semibold text-gray-900">{{ $company->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $company->email }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $company->phone ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm">
                            @if ($company->status === 'active')
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                    Activo
                                </span>
                            @elseif ($company->status === 'inactive')
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                    Inactivo
                                </span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded">
                                    Suspendido
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-center">
                            @can('view', $company)
                                <a href="{{ route('admin.companies.show', $company) }}"
                                    class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('update', $company)
                                <a href="{{ route('admin.companies.edit', $company) }}"
                                    class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete', $company)
                                <form action="{{ route('admin.companies.destroy', $company) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No hay empresas registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 border-t">
        {{ $companies->links() }}
    </div>

</div>
