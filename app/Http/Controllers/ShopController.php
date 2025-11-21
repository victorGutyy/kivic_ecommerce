<?php

namespace App\Http\Controllers;

use App\Models\{Store, Product};
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, Store $store)
    {
        $q    = trim($request->query('q', ''));
        $cat  = $request->query('cat');
        $min  = $request->query('min');
        $max  = $request->query('max');
        $sort = $request->query('sort');

        $query = Product::query()
            ->with('images')
            ->where('active', true)
            ->where('store_id', $store->id);

        // MVP: “categoría” por coincidencia en el título
        if ($cat) {
            $query->where('title', 'like', '%' . $cat . '%');
        }

        if ($q !== '') {
            $query->where(fn ($x) =>
                $x->where('title', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%")
            );
        }

        if ($min !== null && is_numeric($min)) {
            $query->where('price', '>=', (int) $min * 100);
        }
        if ($max !== null && is_numeric($max)) {
            $query->where('price', '<=', (int) $max * 100);
        }

        // Orden
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc'); break;
            case 'price_desc':
                $query->orderBy('price', 'desc'); break;
            case 'new':
                $query->latest(); break;
            default:
                $query->latest(); break;
        }

        $products = $query->paginate(30);

        // Categorías demo (coinciden con tus assets)
        $categories = ['playera', 'pantalon', 'zapatos', 'mochila', 'gorras'];

        // 🔹 Theme de la tienda (kivic-classic, kivic-minimal, kivic-dark)
        $theme = $store->theme ?? 'kivic-classic';

        return view('shop.index', [
            'title'      => ($store->brand_name ?: $store->name) . ' — KIVIC',
            'store'      => $store,
            'products'   => $products,
            'categories' => $categories,
            'theme'      => $theme,
        ]);
    }

    public function show(Store $store, Product $product)
    {
        // Seguridad: que el producto pertenezca a la tienda
        abort_unless($product->store_id === $store->id, 404);

        $product->load('images');

        // 🔹 Theme también en la ficha de producto
        $theme = $store->theme ?? 'kivic-classic';

        return view('shop.show', [
            'title'   => "{$product->title} — KIVIC",
            'store'   => $store,
            'product' => $product,
            'theme'   => $theme,
        ]);
    }
}
