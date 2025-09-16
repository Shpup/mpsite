<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аналитика маркетплейсов</title>
    <!-- Подключение Tailwind CSS (если установлен, иначе добавь через CDN или установи) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Дополнительные стили для точной репликации (цвета, шрифты и т.д. из предположения Figma) */
        body {
            font-family: 'Roboto', sans-serif; /* Предполагаемый шрифт */
            background-color: #f4f6f9; /* Светлый фон */
        }
        .header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e3a8a; /* Синий цвет для логотипа */
        }
        .nav-link {
            color: #4b5563;
            margin-left: 1rem;
        }
        .hero {
            background-color: #1e3a8a;
            color: white;
            padding: 4rem 0;
        }
        .block-placeholder {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 0;
            color: #6b7280;
        }
    </style>
</head>
<body>
<!-- Шапка (Header) -->
<header class="header flex justify-between items-center px-6 py-4">
    <div class="logo">Marketplace Analytics</div>
    <nav>
        <a href="#" class="nav-link">Главная</a>
        <a href="#" class="nav-link">Функции</a>
        <a href="#" class="nav-link">Цены</a>
        <a href="#" class="nav-link">Войти</a>
        <a href="#" class="nav-link bg-blue-600 text-white px-4 py-2 rounded">Регистрация</a>
    </nav>
</header>

<!-- Герой-секция (Hero) -->
<section class="hero text-center">
    <h1 class="text-4xl font-bold mb-4">Аналитика маркетплейсов</h1>
    <p class="text-xl mb-6">Получайте insights по продажам, конкурентам и трендам</p>
    <a href="#" class="bg-white text-blue-900 px-6 py-3 rounded font-semibold">Начать анализ</a>
</section>

<!-- Основной контент с блоками-заглушками -->
<main class="container mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Блок 1: Заглушка для графика продаж -->
    <div class="block-placeholder">
        <h2 class="text-lg font-semibold mb-2">Аналитика продаж</h2>
        <p>Заглушка: Здесь будет график продаж за период.</p>
        <!-- Можно добавить placeholder для chart, напр. пустой div -->
        <div class="h-40 bg-gray-200 flex items-center justify-center">График (placeholder)</div>
    </div>

    <!-- Блок 2: Заглушка для таблицы конкурентов -->
    <div class="block-placeholder">
        <h2 class="text-lg font-semibold mb-2">Конкуренты</h2>
        <p>Заглушка: Список топ-конкурентов.</p>
        <table class="w-full border-collapse">
            <thead>
            <tr><th>Имя</th><th>Продажи</th></tr>
            </thead>
            <tbody>
            <tr><td>Конкурент 1</td><td>1000</td></tr>
            <!-- Заглушки -->
            </tbody>
        </table>
    </div>

    <!-- Блок 3: Заглушка для трендов -->
    <div class="block-placeholder">
        <h2 class="text-lg font-semibold mb-2">Тренды</h2>
        <p>Заглушка: Популярные товары.</p>
        <ul>
            <li>Товар 1</li>
            <li>Товар 2</li>
        </ul>
    </div>

    <!-- Дополнительные блоки, если в Figma больше -->
</main>

<!-- Футер (Footer) -->
<footer class="footer text-center">
    <p>&copy; 2025 Marketplace Analytics. Все права защищены.</p>
</footer>
</body>
</html>
