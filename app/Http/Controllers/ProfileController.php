<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
