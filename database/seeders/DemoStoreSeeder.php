<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Store, Product, ProductImage};

class DemoStoreSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Asegura la tienda demo
        $store = Store::firstOrCreate(
            ['slug' => 'moda-basica'],
            ['name' => 'Moda Básica', 'owner_id' => 1, 'country' => 'CO', 'currency' => 'COP']
        );

        // 2) Catálogo demo (usa los archivos que ya tienes en public/assets/demo)
        $items = [
            ['title' => 'Camiseta Unisex Blanca',  'price' => 35000,  'images' => ['playera1.png']],
            ['title' => 'Camiseta Unisex Negra',   'price' => 36000,  'images' => ['playera2.png']],
            ['title' => 'Hoodie Azul',              'price' => 89000,  'images' => ['pantalon1.png']], // ejemplo visual
            ['title' => 'Jeans Básicos',            'price' => 120000, 'images' => ['pantalon2.png']],

            ['title' => 'Gorra Lakers',             'price' => 65000,  'images' => ['gorras.png']],
            ['title' => 'Gorra Gris',               'price' => 59000,  'images' => ['gorras1.png']],
            ['title' => 'Gorra Blanca',             'price' => 59000,  'images' => ['gorras2.png']],

            ['title' => 'Mochila Urbana',           'price' => 99000,  'images' => ['mochila.png']],
            ['title' => 'Mochila Celeste',          'price' => 109000, 'images' => ['mochila1.png']],
            ['title' => 'Mochila Turquesa',         'price' => 115000, 'images' => ['mochila2.png']],

            ['title' => 'Tenis Rojos',              'price' => 210000, 'images' => ['zapatos2.png']],
            ['title' => 'Tenis Azul/Negro',         'price' => 199000, 'images' => ['zapatos1.png']],

            ['title' => 'Pantalón Deportivo',       'price' => 79000,  'images' => ['pantalon.png']],
            ['title' => 'Jersey Blanco',            'price' => 129000, 'images' => ['playera.png']],
        ];

        foreach ($items as $it) {
            $product = Product::updateOrCreate(
                ['store_id' => $store->id, 'title' => $it['title']],
                [
                    'description' => $it['title'].' de la colección demo KIVIC.',
                    'price'       => $it['price'], // en centavos COP si así lo manejas; ajusta si usas pesos
                    'active'      => true,
                ]
            );

            // Borra imágenes previas para tener una sola versión limpia
            $product->images()->delete();

            foreach ($it['images'] as $pos => $filename) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url'        => 'assets/demo/'.$filename,
                    'position'   => $pos + 1,
                ]);
            }
        }
    }
}
