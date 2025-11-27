<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\ProductImage; // si ya lo tienes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreProductController extends Controller
{
    public function index(Store $store)
    {
        abort_unless($store->owner_id === auth()->id(), 403);

        $products = Product::where('store_id', $store->id)->latest()->paginate(20);

        return view('panel.products.index', compact('store', 'products'));
    }

    public function create(Store $store)
    {
        abort_unless($store->owner_id === auth()->id(), 403);

        return view('panel.products.create', compact('store'));
    }

    public function store(Request $request, Store $store)
    {
        abort_unless($store->owner_id === auth()->id(), 403);

        $data = $request->validate([
            'title'       => ['required','string','max:150'],
            'description' => ['nullable','string'],
            'price'       => ['required','numeric','min:0'],
            'active'      => ['sometimes','boolean'],
            'image'       => ['nullable','image','max:4096'],
        ]);

        $product = Product::create([
            'store_id'    => $store->id,
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'price'       => (int) $data['price'], 
            'active'      => $data['active'] ?? true,
        ]);

        if ($request->hasFile('image')) {
    // Guardar en: storage/app/public/products/....
    $path = $request->file('image')->store('products', 'public');

    // IMPORTANTE: guardamos solo la ruta relativa (products/archivo.jpg)
    ProductImage::create([
        'product_id' => $product->id,
        'url'        => $path, // sin storage/
    ]);
}

        return redirect()
            ->route('stores.products.index', $store)
            ->with('status', 'Producto creado correctamente.');
    }
}
