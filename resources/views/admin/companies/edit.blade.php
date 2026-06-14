<x-admin-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Editar Empresa</h1>
        </div>

        <div class="bg-white rounded-lg shadow">
            <form action="{{ route('admin.companies.update', $company) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Razón Social -->
                <div>
                    <label for="legal_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Razón Social
                    </label>
                    <input type="text" name="legal_name" id="legal_name"
                        value="{{ old('legal_name', $company->legal_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('legal_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Teléfono
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $company->phone) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $company->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Estado *
                    </label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="active" @selected(old('status', $company->status) === 'active')>Activo</option>
                        <option value="inactive" @selected(old('status', $company->status) === 'inactive')>Inactivo</option>
                        <option value="suspended" @selected(old('status', $company->status) === 'suspended')>Suspendido</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('admin.companies.show', $company) }}"
                        class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-admin-layout>