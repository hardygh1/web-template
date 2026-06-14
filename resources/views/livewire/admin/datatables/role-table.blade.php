<div class="bg-white rounded-lg shadow">
    
    <div class="p-4 border-b">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Buscar roles..." 
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Permisos</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($roles as $role)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm font-semibold text-gray-900">{{ $role->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $role->display_name ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm">
                            <span class="text-gray-700">{{ $role->permissions->count() }} permisos</span>
                        </td>
                        <td class="px-6 py-3 text-sm text-center">
                            @can('update_role')
                                <a href="{{ route('admin.roles.edit', $role) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('delete_role')
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro?');">
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
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            No hay roles registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 border-t">
        {{ $roles->links() }}
    </div>

</div>
