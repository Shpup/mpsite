<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Проверка аутентификации и получение данных
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Пожалуйста, войдите в систему.');
        }

        $connectedStores = MarketplaceConnection::where('user_id', auth()->id())
            ->where('is_connected', true)
            ->get();

        return view('dashboard', compact('connectedStores'));
    }
}
