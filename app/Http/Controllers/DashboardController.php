<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $connectedStores = MarketplaceConnection::where('user_id', auth()->id())
            ->where('is_connected', true)
            ->get();

        return view('dashboard', compact('connectedStores'));
    }
}
