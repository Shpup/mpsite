<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подключение магазинов</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Подключение маркетплейса</h1>
    <form action="{{ route('connect') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="marketplace_type" class="block">Тип маркетплейса:</label>
            <select name="marketplace_type" id="marketplace_type" class="border p-2 w-full" onchange="toggleFields()">
                <option value="wb">Wildberries</option>
                <option value="ozon">Ozon</option>
                <option value="yandex-market">Яндекс.Маркет</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block">Название магазина:</label>
            <input type="text" name="name" id="name" class="border p-2 w-full" required>
        </div>
        <div id="wb-fields" class="mb-4 hidden">
            <label for="api_key" class="block">API ключ:</label>
            <input type="text" name="api_key" id="api_key" class="border p-2 w-full">
        </div>
        <div id="ozon-fields" class="mb-4 hidden">
            <label for="client_id" class="block">Client ID:</label>
            <input type="text" name="client_id" id="client_id" class="border p-2 w-full">
            <label for="api_key" class="block">API ключ:</label>
            <input type="text" name="api_key" id="api_key" class="border p-2 w-full">
        </div>
        <div id="yandex-fields" class="mb-4 hidden">
            <label for="client_id" class="block">Client ID:</label>
            <input type="text" name="client_id" id="client_id" class="border p-2 w-full">
            <label for="oauth_token" class="block">OAuth токен:</label>
            <input type="text" name="oauth_token" id="oauth_token" class="border p-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Подключить</button>
    </form>
</div>

<script>
    function toggleFields() {
        var type = document.getElementById('marketplace_type').value;
        document.getElementById('wb-fields').style.display = (type === 'wb') ? 'block' : 'none';
        document.getElementById('ozon-fields').style.display = (type === 'ozon') ? 'block' : 'none';
        document.getElementById('yandex-fields').style.display = (type === 'yandex-market') ? 'block' : 'none';
    }
    toggleFields(); // Инициализация
</script>
</body>
</html>
