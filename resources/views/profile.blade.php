@include('layouts.navigation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Личный кабинет</h2>

                    <!-- Смена пароля -->
                    <form method="POST" action="{{ route('profile.update_password') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="block">Текущий пароль:</label>
                            <input type="password" name="current_password" id="current_password" class="border p-2 w-full" required>
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
                    <h2 class="text-xl font-semibold mt-6 mb-4">Подключенные магазины</h2>
                    @if ($connectedStores->isEmpty())
                        <p>Нет подключенных магазинов.</p>
                    @else
                        <ul>
                            @foreach ($connectedStores as $store)
                                <li>{{ $store->name }} ({{ strtoupper($store->marketplace_type) }})</li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('connect') }}" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Подключить новый магазин</a>
                </div>
            </div>
        </div>
    </div>
