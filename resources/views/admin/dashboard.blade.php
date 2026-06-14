<x-admin-layout>

    {{-- Tarjetas resumen de usuarios --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total de usuarios</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $totalUsers }}
                    </p>
                </div>
                <div class="text-blue-500 text-4xl">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Usuarios verificados</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $activeUsers }}
                    </p>
                </div>
                <div class="text-green-500 text-4xl">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Registrados hoy</p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $usersRegisteredToday }}
                    </p>
                </div>
                <div class="text-orange-500 text-4xl">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Información del Sistema --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">
            <i class="fas fa-info-circle"></i> Información del Sistema
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="border-b pb-3">
                <span class="text-gray-600">Versión de Laravel:</span>
                <span class="font-semibold text-gray-800">{{ app()->version() }}</span>
            </div>
            <div class="border-b pb-3">
                <span class="text-gray-600">Versión de PHP:</span>
                <span class="font-semibold text-gray-800">{{ phpversion() }}</span>
            </div>
            <div class="border-b pb-3">
                <span class="text-gray-600">Entorno:</span>
                <span class="font-semibold text-gray-800">{{ config('app.env') }}</span>
            </div>
            <div class="border-b pb-3">
                <span class="text-gray-600">Debug:</span>
                <span class="font-semibold text-gray-800">{{ config('app.debug') ? 'Habilitado' : 'Deshabilitado' }}</span>
            </div>
        </div>
    </div>

</x-admin-layout>