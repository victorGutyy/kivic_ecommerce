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

   // 🔹 Categorías dinámicas según industria
$categoriesByIndustry = [
    // MODA / VESTUARIO
    'ROPA'        => ['Playeras', 'Pantalones', 'Chaquetas', 'Vestidos', 'Blusas', 'Accesorios'],
    'LENCERÍA'    => ['Brasieres', 'Panties', 'Pijamas', 'Bóxers'],
    'CALZADO'     => ['Zapatos', 'Botas', 'Tenis', 'Sandalias', 'Zapatillas'],
    'MODA INFANTIL' => ['Ropa bebé', 'Ropa niños', 'Zapatos niños', 'Accesorios infantiles'],

    // BELLEZA / ESTÉTICA / CUIDADO PERSONAL
    'ESTÉTICA'    => ['Maquillaje', 'Labiales', 'Skincare', 'Peluquería', 'Uñas'],
    'BELLEZA'     => ['Maquillaje', 'Cremas', 'Perfumes', 'Cabello', 'Accesorios'],
    'BARBERÍA'    => ['Máquinas', 'Ceras', 'Aftershave', 'Cabello', 'Barba'],
    'SPA'         => ['Masajes', 'Aromaterapia', 'Aceites', 'Velas', 'Regalos'],

    // TECNOLOGÍA / ELECTRÓNICA
    'TECNOLOGÍA'          => ['Celulares', 'Computadores', 'Periféricos', 'Accesorios', 'Tablets'],
    'ELECTRÓNICA'         => ['Televisores', 'Audio', 'Video', 'Consolas', 'Accesorios'],
    'GAMING'              => ['Consolas', 'Videojuegos', 'Controles', 'Sillas gamer'],
    'ELECTRODOMÉSTICOS'   => ['Cocina', 'Lavado', 'Refrigeración', 'Pequeños electro'],

    // HOGAR / DECORACIÓN / MUEBLES
    'HOGAR'               => ['Decoración', 'Textiles', 'Baño', 'Organización'],
    'DECORACIÓN'          => ['Cuadros', 'Iluminación', 'Cojines', 'Plantas decorativas'],
    'MUEBLES'             => ['Sala', 'Comedor', 'Alcoba', 'Oficina'],

    // ALIMENTOS / BEBIDAS
    'PANADERÍA'           => ['Pan', 'Repostería', 'Postres', 'Bebidas'],
    'CAFETERÍA'           => ['Café', 'Bebidas frías', 'Snacks', 'Postres'],
    'RESTAURANTE'         => ['Platos fuertes', 'Entradas', 'Bebidas', 'Postres'],
    'MINIMERCADO'         => ['Abarrotes', 'Granos', 'Lácteos', 'Bebidas', 'Aseo'],

    // ASEO / LIMPIEZA
    'ASEO'                => ['Aseo hogar', 'Detergentes', 'Desinfectantes', 'Ambientadores', 'Utensilios'],

    // MASCOTAS
    'MASCOTAS'           => ['Alimentos', 'Juguetes', 'Camas', 'Collares', 'Higiene'],

    // PAPELERÍA / LIBRERÍA / OFICINA
    'PAPELERÍA'          => ['Útiles escolares', 'Oficina', 'Arte', 'Cuadernos'],
    'LIBRERÍA'           => ['Libros', 'Infantil', 'Académicos', 'Best sellers'],

    // FIESTAS / REGALOS
    'REGALOS'            => ['Detalles', 'Peluches', 'Chocolates', 'Arreglos especiales'],
    'FIESTAS'            => ['Decoración', 'Globos', 'Desechables', 'Piñatas'],
    'FLORISTERÍA'        => ['Ramos', 'Arreglos', 'Rosas', 'Plantas'],

    // JOYERÍA / ACCESORIOS
    'JOYERÍA'            => ['Collares', 'Pulseras', 'Anillos', 'Aretes', 'Relojes'],
    'ACCESORIOS'         => ['Gafas', 'Gorras', 'Bolsos', 'Cinturones'],

    // AUTO / MOTO
    'AUTOPARTES'         => ['Repuestos', 'Aceites', 'Accesorios', 'Herramientas'],
    'MOTOS'              => ['Accesorios', 'Repuestos', 'Equipos de protección'],

    // SALUD / FARMACIA / NATURISTA
    'FARMACIA'           => ['Medicamentos', 'Suplementos', 'Cuidado personal', 'Bebés'],
    'TIENDA NATURISTA'   => ['Suplementos', 'Tés', 'Productos naturales', 'Snacks saludables'],

    // NIÑOS / JUGUETES
    'JUGUETERÍA'         => ['Juguetes didácticos', 'Muñecos', 'Juegos de mesa', 'Exterior'],

    // SERVICIOS (GENÉRICO)
    'SERVICIOS'          => ['Consultorías', 'Cursos', 'Asesorías', 'Suscripciones'],

    // 🔚 fallback
    'default'            => ['Productos'],
];


    $industryKey = strtoupper($store->industry ?? '');

    $categories = $categoriesByIndustry[$industryKey] ?? ['Productos'];

    // 🔹 Query base
    $query = Product::query()
        ->with('images')
        ->where('active', true)
        ->where('store_id', $store->id);

    // Categoría → buscar coincidencia en título
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
        $query->where('price', '>=', (int) $min);
    }
    if ($max !== null && is_numeric($max)) {
        $query->where('price', '<=', (int) $max);
    }

    // Orden
    switch ($sort) {
        case 'price_asc': $query->orderBy('price', 'asc'); break;
        case 'price_desc': $query->orderBy('price', 'desc'); break;
        case 'new': default: $query->latest(); break;
    }

    $products = $query->paginate(30);

    // Theme
    $theme = $store->theme ?? 'kivic-classic';

    return view('shop.index', compact(
        'store',
        'products',
        'categories',
        'theme'
    ));
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
