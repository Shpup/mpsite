<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Аналитика маркетплейсов</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
        }
        .header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d32f2f;
        }
        .nav-tab {
            padding: 0.5rem 1rem;
            border-bottom: 2px solid transparent;
            color: #4b5563;
            display: inline-block;
        }
        .nav-tab.active {
            border-bottom-color: #d32f2f;
            color: #d32f2f;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .chart-placeholder {
            height: 200px;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
        }
    </style>
</head>
<body>
<!-- Шапка -->
<header class="header">
    <div class="logo flex items-center">
        <span>bu</span>
    </div>
    <div class="flex items-center space-x-4">
        <input type="text" placeholder="Поиск по SKU" class="border rounded p-1">
        <button class="text-gray-500"><i class="fas fa-search"></i></button>
        <button class="text-gray-500"><i class="fas fa-bell"></i><span class="ml-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">1</span></button>
        <button class="text-gray-500"><i class="fas fa-user"></i></button>
    </div>
</header>

<!-- Навигация по маркетплейсам -->
<nav class="bg-white border-b">
    <ul class="flex space-x-4 p-2">
        <li><a href="#" class="nav-tab">Все</a></li>
        @if (!isset($connectedStores) || $connectedStores->isEmpty())
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
    @if (!isset($connectedStores) || $connectedStores->isEmpty())
        <div class="card col-span-3 text-center">
            <h2 class="text-lg font-semibold mb-2">Нет подключенных магазинов</h2>
            <p>Перейдите в раздел подключения, чтобы добавить маркетплейсы.</p>
            <a href="{{ route('connect') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Подключить магазины</a>
        </div>
    @else
        <!-- Динамика товаров -->
        <div class="card col-span-2">
            <h2 class="text-lg font-semibold mb-2">Динамика товаров</h2>
            <div class="chart-placeholder">График (заглушка)</div>
            <div class="text-sm text-gray-500 mt-2">Смотреть</div>
        </div>

        <!-- Финансовая сводка -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Финансовая сводка <span class="text-blue-500">(Демо-данные)</span></h2>
            <p>Выручка: 7 132 343,00 ₽</p>
            <p>Прибыль: 3 453 033,08 ₽</p>
            <div class="mt-2">
                <span class="inline-block w-3 h-3 bg-purple-500 mr-1"></span> Удержания
                <span class="inline-block w-3 h-3 bg-orange-500 mr-1"></span> Продвижение
                <span class="inline-block w-3 h-3 bg-green-500 mr-1"></span> Прибыль
            </div>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Поставки WB -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Поставки <span class="text-blue-500">WB</span></h2>
            <p>Срочно к поставке WB: 1 428</p>
            <p>Упущенные продажи: 876</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Реклама -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Реклама</h2>
            <p>3 388 042,63 ₽</p>
            <p>291 267,29 ₽</p>
            <p>3 453 033,08 ₽</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Заросы: сейчас в тренде -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Заросы: сейчас в тренде <span class="text-blue-500">(Демо-данные)</span></h2>
            <p>Управление ценой</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Отзывы и вопросы -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Отзывы и вопросы <span class="text-blue-500">(Демо-данные)</span></h2>
            <p>Товары в акции: 63</p>
            <p>Акции: 8</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Рука на пульсе -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Рука на пульсе <span class="text-blue-500">(Демо-данные)</span></h2>
            <p>Зоны роста бизнеса: Рекомендации</p>
            <p>6</p>
            <p>26</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>

        <!-- Заросы: сейчас в тренде (второй блок) -->
        <div class="card">
            <h2 class="text-lg font-semibold mb-2">Заросы: сейчас в тренде <span class="text-blue-500">(Демо-данные)</span></h2>
            <p>Управление ценой</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-1 rounded">Перейти</button>
        </div>
    @endif
</main>
</body>
</html>
