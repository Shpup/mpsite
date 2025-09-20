<nav x-data="{ open: false, searchOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Hamburger (переключение бокового меню) -->
                <div class="flex items-center">
                    <button @click="open = !open;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Logo -->
                <div class="shrink-0 flex items-center ml-4">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto"> <!-- Размер логотипа: 100x50 px -->
                    </a>
                </div>
            </div>

            <!-- Right side: Search, Notifications, Profile -->
            <div class="flex items-center space-x-4">
                <!-- Поиск -->
                <div x-data="{ searchActive: false }" class="relative">
                    <button @click="searchActive = !searchActive" class="p-2 text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <div x-show="searchActive" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50">
                        <div class="p-2">
                            <input type="text" placeholder="Поиск по SKU" class="w-full border rounded p-2 focus:outline-none" x-ref="searchInput">
                            <button @click="searchActive = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-500">×</button>
                        </div>
                    </div>
                </div>

                <!-- Уведомления -->
                <div class="relative">
                    <button class="p-2 text-gray-400 hover:text-gray-500 focus:outline-none relative">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">1</span>
                    </button>
                </div>

                <!-- Профиль (ЛК) -->
                <div class="relative">
                    <a href="{{ route('profile') }}" class="p-2 text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Боковое меню (выдвигается слева, растягивается до низа) -->
    <aside x-show="open" class="fixed inset-y-0 h-full min-h-screen left-0 z-60 w-64 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 ease-in-out" :class="{ 'translate-x-0': open, '-translate-x-full': !open }">
        <div class="h-full min-h-screen flex flex-col">
            <div class="flex-shrink-0 p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Меню</h2>
            </div>
            <div class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('profile') }}" class="block px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700">Profile</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700">Settings</a>
                <a href="{{ route('logout') }}" class="block px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
    </aside>

    <!-- Оверлей для блокировки основного контента -->
    <div x-show="open" x-transition:enter="transition-opacity duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-50" @click="open = false"></div>
</nav>

<style>
    .bg-smoke-light {
        background-color: rgba(0, 0, 0, 0.6);
    }
    /* Убираем горизонтальный скролл */
    body {
        overflow-x: hidden;
    }
    /* Скрываем элементы до загрузки Alpine */
    [x-cloak] {
        display: none;
    }
    /* Адаптивное поведение */
    @media (max-width: 767px) {
        aside {
            display: none; /* Скрываем на мобильных устройствах */
        }
        .content {
            margin-left: 0 !important;
        }
    }
    /* Сдвигаем основной контент при открытом меню */
    .content {
        margin-left: 0;
        transition: margin-left 0.3s ease-in-out;
    }
    .content[x-show="open"] {
        margin-left: 64px; /* Ширина меню */
    }
</style>
