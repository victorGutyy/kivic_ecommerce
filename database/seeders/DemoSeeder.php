<?php

use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductImage;

// ...

$catalog = [
    [
        'title' => 'Camiseta Unisex Blanca',
        'price' => 35000,
        'img'   => '/assets/demo/tshirt_white.jpg',
        'variants' => [
            ['size' => 'S', 'color' => 'Blanco', 'stock' => 5],
            ['size' => 'M', 'color' => 'Blanco', 'stock' => 8],
            ['size' => 'L', 'color' => 'Blanco', 'stock' => 6],
        ],
    ],
    [
        'title' => 'Camiseta Unisex Negra',
        'price' => 36000,
        'img'   => '/assets/demo/tshirt_black.jpg',
        'variants' => [
            ['size' => 'S', 'color' => 'Negro', 'stock' => 7],
            ['size' => 'M', 'color' => 'Negro', 'stock' => 10],
            ['size' => 'L', 'color' => 'Negro', 'stock' => 4],
        ],
    ],
    [
        'title' => 'Hoodie Azul',
        'price' => 89000,
        'img'   => '/assets/demo/hoodie_blue.jpg',
        'variants' => [
            ['size' => 'M', 'color' => 'Azul', 'stock' => 3],
            ['size' => 'L', 'color' => 'Azul', 'stock' => 5],
        ],
    ],
    [
        'title' => 'Jeans Básicos',
        'price' => 120000,
        'img'   => '/assets/demo/jeans_basic.jpg',
        'variants' => [
            ['size' => '30', 'color' => 'Azul', 'stock' => 6],
            ['size' => '32', 'color' => 'Azul', 'stock' => 6],
            ['size' => '34', 'color' => 'Azul', 'stock' => 6],
        ],
    ],
];

foreach ($catalog as $c) {
    $product = Product::create([
        'store_id'    => $store->id,                 // asegúrate de tener $store definido arriba
        'title'       => $c['title'],
        'description' => 'Producto demo para KIVIC E-Commerce',
        'price'       => $c['price'],
        'active'      => true,
    ]);

    ProductImage::create([
        'product_id' => $product->id,
        'url'        => $c['img'],
        'position'   => 1,
    ]);

    foreach ($c['variants'] as $v) {
        Variant::create([
            'product_id' => $product->id,
            'sku'        => Str::upper(Str::random(8)),
            'size'       => $v['size'] ?? null,
            'color'      => $v['color'] ?? null,
            'price'      => $c['price'],
            'stock'      => $v['stock'] ?? 0,
        ]);
    }
}
