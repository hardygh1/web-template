@props([
    'permissions',
    'selected' => [],
])

<x-wire-card>
    <h2 class="text-base font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-200">
        Asignación de permisos
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-500 w-8">#</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-500">Módulo</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-500">Ver</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-500">Crear</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-500">Actualizar</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-500">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rowIndex = 1;
                    $actionMap = [
                        'read'   => 'ver',
                        'access' => 'ver',
                        'create' => 'crear',
                        'update' => 'actualizar',
                        'delete' => 'eliminar',
                    ];
                    $columns = ['ver', 'crear', 'actualizar', 'eliminar'];
                @endphp

                @foreach ($permissions as $module => $items)
                    @php
                        $byColumn = [];
                        foreach ($items as $perm) {
                            $prefix = explode('_', $perm->name)[0];
                            $col = $actionMap[$prefix] ?? null;
                            if ($col) $byColumn[$col] = $perm->name;
                        }
                    @endphp
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4 text-gray-400">{{ $rowIndex++ }}</td>
                        <td class="py-3 px-4 font-medium text-gray-700 capitalize">
                            {{ str_replace('_', ' ', $module) }}
                        </td>

                        @foreach ($columns as $col)
                            <td class="py-3 px-4 text-center">
                                @if (isset($byColumn[$col]))
                                    @php
                                        $permName = $byColumn[$col];
                                        $isOn     = in_array($permName, old('permissions', $selected));
                                        $btnId    = 'btn_' . $permName;
                                        $cbId     = 'cb_' . $permName;
                                    @endphp

                                    <input
                                        type="checkbox"
                                        id="{{ $cbId }}"
                                        name="permissions[]"
                                        value="{{ $permName }}"
                                        class="hidden"
                                        {{ $isOn ? 'checked' : '' }}
                                    >

                                    <button
                                        type="button"
                                        id="{{ $btnId }}"
                                        data-cb="{{ $cbId }}"
                                        onclick="togglePerm(this)"
                                        class="px-5 py-1 rounded font-bold text-xs transition-colors duration-150 min-w-[52px]
                                            {{ $isOn ? 'bg-emerald-500 text-white' : 'border border-gray-500 text-gray-500 bg-white' }}"
                                    >
                                        {{ $isOn ? 'ON' : 'OFF' }}
                                    </button>
                                @else
                                    <span class="text-gray-200">—</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-wire-card>

<script>
    function togglePerm(btn) {
        const cb = document.getElementById(btn.dataset.cb);
        cb.checked = !cb.checked;

        if (cb.checked) {
            btn.textContent = 'ON';
            btn.style.backgroundColor = '#10b981';
            btn.style.color = '#ffffff';
            btn.style.border = 'none';
        } else {
            btn.textContent = 'OFF';
            btn.style.backgroundColor = '#ffffff';
            btn.style.color = '#6b7280';
            btn.style.border = '1px solid #6b7280';
        }
    }
</script>