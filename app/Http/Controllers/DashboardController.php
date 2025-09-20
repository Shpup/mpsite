<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Пожалуйста, войдите в систему.');
        }

        $platforms = [
            'all' => 'Все',
            'wb' => 'WB',
            'ozon' => 'Ozon',
            'yandex-market' => 'Я.Маркет',
        ];

        $selectedPlatform = $request->input('platform', 'all');
        $selectedStoreId = $request->input('store', 'all');

        // Получаем все подключенные магазины текущего пользователя
        $connectedStores = MarketplaceConnection::where('user_id', auth()->id())
            ->where('is_connected', true)
            ->get();

        if ($connectedStores->isEmpty()) {
            \Log::warning('No connected stores found for user ID: ' . auth()->id());
        } else {
            \Log::info('Connected stores: ', $connectedStores->toArray());
        }

        $platformStores = $connectedStores->filter(function ($store) use ($selectedPlatform) {
            return $selectedPlatform === 'all' || $store->marketplace_type === $selectedPlatform;
        });

        // Заглушка для статистики
        $statistics = $this->getStatistics($selectedPlatform, $selectedStoreId, $platformStores);

        return view('dashboard', compact('platforms', 'selectedPlatform', 'platformStores', 'selectedStoreId', 'statistics', 'connectedStores'));
    }

    protected function getStatistics($platform, $storeId, $stores)
    {
        if ($storeId !== 'all') {
            $store = $stores->firstWhere('id', $storeId);
            return ['message' => 'Статистика для магазина: ' . ($store ? $store->name : 'Не найден')];
        } elseif ($platform !== 'all') {
            return ['message' => 'Статистика по всем магазинам площадки: ' . $platform, 'store_count' => $stores->count()];
        } else {
            return ['message' => 'Общая статистика по всем площадкам', 'total_stores' => $stores->count()];
        }
    }
}
