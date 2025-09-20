@include('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold mb-4">Личный кабинет</h2>

                <!-- Смена пароля -->
                <form method="POST" action="{{ route('profile.update_password') }}" class="mb-6">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="block">Текущий пароль:</label>
                        <input type="password" name="current_password" id="current_password" class="border p-2 w-full" required>
                        @error('current_password')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block">Новый пароль:</label>
                        <input type="password" name="password" id="password" class="border p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block">Подтверждение пароля:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="border p-2 w-full" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Обновить пароль</button>
                </form>

                <!-- Подключенные магазины -->
                <h2 class="text-xl font-semibold mb-4">Подключенные магазины</h2>
                @if ($connectedStores->isEmpty())
                    <p>Нет подключенных магазинов.</p>
                @else
                    <ul class="space-y-4">
                        @foreach ($connectedStores as $store)
                            <li class="border p-4 rounded">
                                <div>{{ $store->name }} ({{ strtoupper($store->marketplace_type) }})</div>
                                <div class="mt-2 space-x-2">
                                    <!-- Изменение -->
                                    <form method="POST" action="{{ route('profile.update_store', $store->id) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $store->name }}" class="border p-1" required>
                                        <input type="text" name="api_key" value="{{ $store->api_key }}" class="border p-1" placeholder="API Key">
                                        <input type="text" name="client_id" value="{{ $store->client_id }}" class="border p-1" placeholder="Client ID">
                                        <input type="text" name="oauth_token" value="{{ $store->oauth_token }}" class="border p-1" placeholder="OAuth Token">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Сохранить</button>
                                    </form>
                                    <!-- Удаление -->
                                    <form method="POST" action="{{ route('profile.delete_store', $store->id) }}" class="inline" onclick="return confirm('Удалить магазин?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Удалить</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Подключение нового магазина -->
                <h2 class="text-xl font-semibold mt-6 mb-4">Подключить новый магазин</h2>
                <form method="POST" action="{{ route('profile.connect_store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="marketplace_type" class="block">Тип маркетплейса:</label>
                        <select name="marketplace_type" id="marketplace_type" class="border p-2 w-full">
                            <option value="wb">Wildberries</option>
                            <option value="ozon">Ozon</option>
                            <option value="yandex-market">Яндекс.Маркет</option>
                        </select>
                    </div>
                    <div>
                        <label for="name" class="block">Название магазина:</label>
                        <input type="text" name="name" id="name" class="border p-2 w-full" required>
                    </div>
                    <div>
                        <label for="api_key" class="block">API ключ:</label>
                        <input type="text" name="api_key" id="api_key" class="border p-2 w-full">
                    </div>
                    <div>
                        <label for="client_id" class="block">Client ID:</label>
                        <input type="text" name="client_id" id="client_id" class="border p-2 w-full">
                    </div>
                    <div>
                        <label for="oauth_token" class="block">OAuth токен:</label>
                        <input type="text" name="oauth_token" id="oauth_token" class="border p-2 w-full">
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Подключить</button>
                </form>
            </div>
        </div>
    </div>
</div>
