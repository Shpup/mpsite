@include('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="py-12" x-data="{ passwordModal: false, addModal: false, editModal: {} }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold mb-4">Личный кабинет</h2>

                <!-- Кнопка изменения пароля -->
                <button @click="passwordModal = true" class="bg-blue-500 text-white px-4 py-2 rounded mb-6">Изменить пароль</button>

                <!-- Модальное окно для изменения пароля -->
                <div x-show="passwordModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex">
                    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold mb-4">Изменить пароль</h3>
                        <form method="POST" action="{{ route('profile.update_password') }}">
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
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Обновить</button>
                            <button type="button" @click="passwordModal = false" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Закрыть</button>
                        </form>
                    </div>
                </div>

                <!-- Подключенные магазины (сгруппированы по маркетплейсам) -->
                <h2 class="text-xl font-semibold mb-4">Подключенные магазины</h2>
                @if ($connectedStores->isEmpty())
                    <p>Нет подключенных магазинов.</p>
                @else
                    @foreach ($connectedStores->groupBy('marketplace_type') as $type => $stores)
                        <h3 class="text-lg font-medium mt-4">{{ strtoupper($type) }}</h3>
                        <ul class="space-y-4">
                            @foreach ($stores as $store)
                                <li class="border p-4 rounded">
                                    <div>{{ $store->name }}</div>
                                    <div class="mt-2 space-x-2">
                                        <button @click="editModal = { id: '{{ $store->id }}', name: '{{ $store->name }}', marketplace_type: '{{ $store->marketplace_type }}', api_key: '{{ $store->api_key }}', client_id: '{{ $store->client_id }}', oauth_token: '{{ $store->oauth_token }}' }" class="bg-yellow-500 text-white px-2 py-1 rounded">Изменить</button>
                                        <form method="POST" action="{{ route('profile.delete_store', $store->id) }}" class="inline" onclick="return confirm('Удалить магазин?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Удалить</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif

                <!-- Кнопка подключения нового магазина -->
                <button @click="addModal = true" class="bg-green-500 text-white px-4 py-2 rounded mt-6">Подключить новый магазин</button>

                <!-- Модальное окно для добавления магазина -->
                <div x-show="addModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex">
                    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold mb-4">Подключить новый магазин</h3>
                        <form method="POST" action="{{ route('profile.connect_store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="marketplace_type" class="block">Тип маркетплейса:</label>
                                <select name="marketplace_type" id="marketplace_type" class="border p-2 w-full" x-ref="addType" @change="toggleFields('add')">
                                    <option value="wb">Wildberries</option>
                                    <option value="ozon">Ozon</option>
                                    <option value="yandex-market">Яндекс.Маркет</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block">Название магазина:</label>
                                <input type="text" name="name" id="name" class="border p-2 w-full" required>
                            </div>
                            <div id="add-wb-fields" class="mb-4" style="display: none;">
                                <label for="api_key" class="block">API ключ:</label>
                                <input type="text" name="api_key" id="api_key" class="border p-2 w-full" required>
                            </div>
                            <div id="add-ozon-fields" class="mb-4" style="display: none;">
                                <label for="client_id" class="block">Client ID:</label>
                                <input type="text" name="client_id" id="client_id" class="border p-2 w-full" required>
                                <label for="api_key" class="block">API ключ:</label>
                                <input type="text" name="api_key" id="api_key" class="border p-2 w-full" required>
                            </div>
                            <div id="add-yandex-fields" class="mb-4" style="display: none;">
                                <label for="client_id" class="block">Client ID:</label>
                                <input type="text" name="client_id" id="client_id" class="border p-2 w-full" required>
                                <label for="oauth_token" class="block">OAuth токен:</label>
                                <input type="text" name="oauth_token" id="oauth_token" class="border p-2 w-full" required>
                            </div>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Подключить</button>
                            <button type="button" @click="addModal = false" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Закрыть</button>
                        </form>
                    </div>
                </div>

                <!-- Модальное окно для изменения магазина -->
                <div x-show="editModal.id" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex">
                    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold mb-4">Изменить магазин</h3>
                        <form method="POST" action="{{ route('profile.update_store', 'editModal.id') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block">Название магазина:</label>
                                <input type="text" name="name" :value="editModal.name" class="border p-2 w-full" required>
                            </div>
                            <div :style="{ display: editModal.marketplace_type === 'wb' ? 'block' : 'none' }">
                                <label for="api_key" class="block">API ключ:</label>
                                <input type="text" name="api_key" :value="editModal.api_key" class="border p-2 w-full" required>
                            </div>
                            <div :style="{ display: editModal.marketplace_type === 'ozon' ? 'block' : 'none' }">
                                <label for="client_id" class="block">Client ID:</label>
                                <input type="text" name="client_id" :value="editModal.client_id" class="border p-2 w-full" required>
                                <label for="api_key" class="block">API ключ:</label>
                                <input type="text" name="api_key" :value="editModal.api_key" class="border p-2 w-full" required>
                            </div>
                            <div :style="{ display: editModal.marketplace_type === 'yandex-market' ? 'block' : 'none' }">
                                <label for="client_id" class="block">Client ID:</label>
                                <input type="text" name="client_id" :value="editModal.client_id" class="border p-2 w-full" required>
                                <label for="oauth_token" class="block">OAuth токен:</label>
                                <input type="text" name="oauth_token" :value="editModal.oauth_token" class="border p-2 w-full" required>
                            </div>
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Сохранить</button>
                            <button type="button" @click="editModal = {}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Закрыть</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleFields(modal) {
        let type = document.getElementById(modal + '_marketplace_type').value;
        document.getElementById(modal + '-wb-fields').style.display = (type === 'wb') ? 'block' : 'none';
        document.getElementById(modal + '-ozon-fields').style.display = (type === 'ozon') ? 'block' : 'none';
        document.getElementById(modal + '-yandex-fields').style.display = (type === 'yandex-market') ? 'block' : 'none';
    }
</script>
