<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Аналитика маркетплейсов' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f7f7f7; }
        .header { background-color: #ffffff; border-bottom: 1px solid #e5e7eb; padding: 0.5rem 1rem; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: #d32f2f; }
        .nav-tab { padding: 0.5rem 1rem; border-bottom: 2px solid transparent; color: #4b5563; display: inline-block; }
        .nav-tab.active { border-bottom-color: #d32f2f; color: #d32f2f; }
        .card { background-color: #ffffff; border: 0.5px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem; margin-bottom: 0.5rem; }
        .chart-placeholder { height: 200px; background-color: #ffffff; display: flex; align-items: center; justify-content: center; color: #ffffff; }
        .store-select { border: 1px solid #e5e7eb; padding: 0.5rem; border-radius: 0.5rem; background-color: #f9fafb; margin-left: 1rem; }
        .bg-smoke-light { background-color: rgba(0, 0, 0, 0.6); }
    </style>
</head>
<body>
@include('layouts.navigation')

<!-- Унифицированная обертка контента для сдвига при открытом меню -->
<div class="content min-h-screen transition-all duration-300 ease-in-out" :class="{ 'ml-64': open, 'ml-0': !open }">
    @yield('content')
</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
