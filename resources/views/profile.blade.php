@include('layouts.navigation')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="py-12" x-data="{ passwordModal: false, addModal: false, addType: 'wb', editModal: {}, toggleFields(type, modal) { let fields = ['wb-fields', 'ozon-fields', 'yandex-fields']; fields.forEach(f => document.getElementById(modal + '-' + f).style.display = 'none'); if (type === 'wb') document.getElementById(modal + '-' + f).style.display = 'block'; else if (type === 'ozon') document.getElementById(modal + '-' + f).style.display = 'block'; else if (type === 'yandex-market') document.getElementById(modal + '-' + f).style.display = 'block'; } }">
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
                                <input type="password" name="current_password" class="border p-2 w-full" required>
                                @error('current_password')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block">Новый пароль:</label>
                                <input type="password" name="password" class="border p-2 w-full" required>
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block">Подтверждение пароля:</label>
                                <input type="password" name="password_confirmation" class="border p-2 w-full" required>
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
                                <li class="border p-4 rounded flex justify-between items-center">
                                    <div class="text-lg">{{ $store->name }}</div>
                                    <div class="space-x-2">
                                        <button @click="editModal = { id: '{{ $store->id }}', name: '{{ $store->name }}', marketplace_type: '{{ $store->marketplace_type }}', api_key: '{{ $store->api_key }}', client_id: '{{ $store->client_id }}', oauth_token: '{{ $store->oauth_token }}' }; toggleFields(editModal.marketplace_type, 'edit')" class="bg-yellow-500 text-white px-2 py-1 rounded">Изменить</button>
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
                <button @click="addModal = true; toggleFields(addType, 'add')" class="bg-green-500 text-white px-4 py-2 rounded mt-6">Подключить новый магазин</button>

                <!-- Модальное окно для добавления магазина -->
                <div x-show="addModal" class="fixed inset-0 z-50 overflow-auto bg-smoke-light flex">
                    <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold mb-4">Подключить новый магазин</h3>
                        <form method="POST" action="{{ route('profile.connect_store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="marketplace_type_add" class="block">Тип маркетплейса:</label>
                                <select name="marketplace_type" id="marketplace_type_add" class="border p-2 w-full" x-model="addType" @change="toggleFields($event.target.value, 'add')">
                                    <option value="wb">Wildberries</option>
                                    <option value="ozon">Ozon</option>
                                    <option value="yandex-market">Яндекс.Маркет</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="name_add" class="block">Название магазина:</label>
                                <input type="text" name="name" id="name_add" class="border p-2 w-full" required>
                            </div>
                            <div id="add-wb-fields" class="mb-4" x-show="addType === 'wb'">
                                <label for="api_key_add" class="block">API ключ:</label>
                                <input type="text" name="api_key" id="api_key_add" class="border p-2 w-full" x-bind:required="addType === 'wb'">
                            </div>
                            <div id="add-ozon-fields" class="mb-4" x-show="addType === 'ozon'">
                                <label for="client_id_add" class="block">Client ID:</label>
                                <input type="text" name="client_id" id="client_id_add" class="border p-2 w-full" x-bind:required="addType === 'ozon'">
                                <label for="api_key_add" class="block">API ключ:</label>
                                <input type="text" name="api_key" id="api_key_add" class="border p-2 w-full" x-bind:required="addType === 'ozon'">
                            </div>
                            <div id="add-yandex-fields" class="mb-4" x-show="addType === 'yandex-market'">
                                <label for="client_id_add" class="block">Client ID:</label>
                                <input type="text" name="client_id" id="client_id_add" class="border p-2 w-full" x-bind:required="addType === 'yandex-market'">
                                <label for="oauth_token_add" class="block">OAuth токен:</label>
                                <input type="text" name="oauth_token" id="oauth_token_add" class="border p-2 w-full" x-bind:required="addType === 'yandex-market'">
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
                        <form method="POST" action="{{ route('profile.update_store', ['id' => 'editModal.id']) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name_edit" class="block">Название магазина:</label>
                                <input type="text" name="name" x-bind:value="editModal.name" id="name_edit" class="border p-2 w-full" required>
                            </div>
                            <div id="edit-wb-fields" class="mb-4" x-show="editModal.marketplace_type === 'wb'">
                                <label for="api_key_edit" class="block">API ключ:</label>
                                <input type="text" name="api_key" x-bind:value="editModal.api_key" id="api_key_edit" class="border p-2 w-full" x-bind:required="editModal.marketplace_type === 'wb'">
                            </div>
                            <div id="edit-ozon-fields" class="mb-4" x-show="editModal.marketplace_type === 'ozon'">
                                <label for="client_id_edit" class="block">Client ID:</label>
                                <input type="text" name="client_id" x-bind:value="editModal.client_id" id="client_id_edit" class="border p-2 w-full" x-bind:required="editModal.marketplace_type === 'ozon'">
                                <label for="api_key_edit" class="block">API ключ:</label>
                                <input type="text" name="api_key" x-bind:value="editModal.api_key" id="api_key_edit" class="border p-2 w-full" x-bind:required="editModal.marketplace_type === 'ozon'">
                            </div>
                            <div id="edit-yandex-fields" class="mb-4" x-show="editModal.marketplace_type === 'yandex-market'">
                                <label for="client_id_edit" class="block">Client ID:</label>
                                <input type="text" name="client_id" x-bind:value="editModal.client_id" id="client_id_edit" class="border p-2 w-full" x-bind:required="editModal.marketplace_type === 'yandex-market'">
                                <label for="oauth_token_edit" class="block">OAuth токен:</label>
                                <input type="text" name="oauth_token" x-bind:value="editModal.oauth_token" id="oauth_token_edit" class="border p-2 w-full" x-bind:required="editModal.marketplace_type === 'yandex-market'">
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
