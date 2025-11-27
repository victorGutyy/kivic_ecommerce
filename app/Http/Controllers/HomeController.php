<?php

namespace App\Http\Controllers;

use App\Models\Store;

class HomeController extends Controller
{
    public function index()
    {
        // Tomamos las últimas 12 tiendas con logo
        $featuredStores = Store::whereNotNull('logo_path')
            ->orderByDesc('created_at')
            ->take(12)
            ->get();

        return view('home', compact('featuredStores'));
    }
}
