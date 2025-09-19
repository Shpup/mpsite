<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConnectionController extends Controller
{
    public function index()
    {
        return view('connect');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marketplace_type' => 'required|in:wb,ozon,yandex-market',
            'name' => 'required|string|max:255',
            'api_key' => 'required_if:marketplace_type,wb,ozon|string|max:255',
            'client_id' => 'required_if:marketplace_type,ozon,yandex-market|string|max:255',
            'oauth_token' => 'required_if:marketplace_type,yandex-market|string|max:255',
        ]);

        $slug = Str::slug($validated['name']);

        MarketplaceConnection::create([
            'user_id' => auth()->id(),
            'marketplace_type' => $validated['marketplace_type'],
            'name' => $validated['name'],
            'slug' => $slug,
            'api_key' => $validated['api_key'] ?? null,
            'client_id' => $validated['client_id'] ?? null,
            'oauth_token' => $validated['oauth_token'] ?? null,
            'is_connected' => true, // Здесь можно добавить реальную проверку API, например, curl-запрос
        ]);

        return redirect()->route('dashboard')->with('success', 'Магазин подключен!');
    }
}
