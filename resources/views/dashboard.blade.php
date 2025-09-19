<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Аналитика маркетплейсов</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Твои стили */
    </style>
</head>
<body>
<!-- Шапка -->
<header class="header">
    <!-- Твоя шапка -->
</header>

<!-- Навигация по маркетплейсам -->
<nav class="bg-white border-b">
    <ul class="flex space-x-4 p-2">
        <li><a href="#" class="nav-tab">Все</a></li>
        @if ($connectedStores->isEmpty())
            <li class="text-red-500">Нет подключенных магазинов. <a href="{{ route('connect') }}" class="text-blue-500">Подключить</a></li>
        @else
            @foreach ($connectedStores as $store)
                <li><a href="#" class="nav-tab {{ request()->path() === 'dashboard/' . $store->slug ? 'active' : '' }}">{{ $store->name }}</a></li>
            @endforeach
        @endif
    </ul>
</nav>

<!-- Основной контент -->
<main class="container mx-auto p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
    @if ($connectedStores->isEmpty())
        <div class="card col-span-3 text-center">
            <h2 class="text-lg font-semibold mb-2">Нет подключенных магазинов</h2>
            <p>Перейдите в раздел подключения, чтобы добавить маркетплейсы.</p>
            <a href="{{ route('connect') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Подключить магазины</a>
        </div>
    @else
        <!-- Твои карточки с заглушками -->
    @endif
</main>
</body>
</html>
