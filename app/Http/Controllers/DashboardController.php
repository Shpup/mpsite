<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($storeSlug = null)
    {
        $connectedStores = Store::where('is_connected', true)->get();
        $selectedStore = $storeSlug ? Store::where('slug', $storeSlug)->first() : $connectedStores->first();
        return view('dashboard', compact('connectedStores', 'selectedStore'));
    }
}
