<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $connectedStores = MarketplaceConnection::where('user_id', auth()->id())->where('is_connected', true)->get();

        return view('profile', compact('connectedStores'));
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();
        if (Hash::check($validated['current_password'], $user->password)) {
            $user->update(['password' => Hash::make($validated['password'])]);
            return redirect()->route('profile')->with('success', 'Пароль обновлен');
        }

        return back()->withErrors(['current_password' => 'Текущий пароль неверный']);
    }

    public function connectStore(Request $request)
    {
        Log::info('connectStore called with data:', $request->all());
        Log::info('Authenticated user ID: ' . (auth()->id() ?? 'Not authenticated'));

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему.');
        }

        // Логируем сырые данные перед валидацией
        Log::info('Raw input data:', $request->input());

        try {
            $validated = $request->validate([
                'marketplace_type' => 'required|in:wb,ozon,yandex-market',
                'name' => 'required|string|max:255',
                'api_key' => 'nullable|string|max:255', // Убрали required_if, полагаемся на фронтенд
                'client_id' => 'nullable|string|max:255',
                'oauth_token' => 'nullable|string|max:255',
            ]);

            Log::info('Validated data:', $validated);

            $store = MarketplaceConnection::create([
                'user_id' => auth()->id(),
                'marketplace_type' => $validated['marketplace_type'],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'api_key' => $validated['api_key'] ?? null,
                'client_id' => $validated['client_id'] ?? null,
                'oauth_token' => $validated['oauth_token'] ?? null,
                'is_connected' => true,
            ]);

            Log::info('Created store:', $store->toArray());

            return redirect()->route('profile')->with('success', 'Магазин подключен');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors(), 'input' => $request->all()]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Exception in connectStore:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Произошла ошибка при подключении магазина.');
        }
    }

    public function updateStore(Request $request, $id)
    {
        $store = MarketplaceConnection::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'api_key' => 'required_if:marketplace_type,wb,ozon|string|max:255',
            'client_id' => 'required_if:marketplace_type,ozon,yandex-market|string|max:255',
            'oauth_token' => 'required_if:marketplace_type,yandex-market|string|max:255',
        ]);

        $store->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'api_key' => $validated['api_key'] ?? $store->api_key,
            'client_id' => $validated['client_id'] ?? $store->client_id,
            'oauth_token' => $validated['oauth_token'] ?? $store->oauth_token,
        ]);

        return redirect()->route('profile')->with('success', 'Магазин обновлен');
    }

    public function deleteStore($id)
    {
        $store = MarketplaceConnection::findOrFail($id);
        $store->delete();

        return redirect()->route('profile')->with('success', 'Магазин удален');
    }
}
