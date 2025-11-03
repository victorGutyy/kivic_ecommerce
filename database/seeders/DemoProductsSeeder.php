<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Store,Product,ProductImage};
use Illuminate\Support\Str;

class DemoProductsSeeder extends Seeder
{
    public function run(): void
    {
        $store = Store::firstOrCreate(
            ['slug'=>'moda-basica'],
            ['name'=>'Moda Básica Demo']
        );

        $files = collect([
            ['title'=>'Gorra Lakers Morada','file'=>'demo/gorras.png','cat'=>'gorras', 'price'=>14700],
            ['title'=>'Gorra Negra','file'=>'demo/gorras1.png','cat'=>'gorras', 'price'=>14500],
            ['title'=>'Playera Smart','file'=>'demo/playera1.png','cat'=>'playera','price'=>20000],
            ['title'=>'Playera Negra','file'=>'demo/playera2.png','cat'=>'playera','price'=>13900],
            ['title'=>'Pantalón Yoga','file'=>'demo/pantalon.png','cat'=>'pantalon','price'=>24000],
            ['title'=>'Pantalón Gris','file'=>'demo/pantalon1.png','cat'=>'pantalon','price'=>21900],
            ['title'=>'Mochila Gris','file'=>'demo/mochila.png','cat'=>'mochila','price'=>19900],
            ['title'=>'Mochila Celeste','file'=>'demo/mochila1.png','cat'=>'mochila','price'=>22900],
            ['title'=>'Mochila Turquesa','file'=>'demo/mochila2.png','cat'=>'mochila','price'=>20900],
            ['title'=>'Zapatillas Rojas','file'=>'demo/zapatos.png','cat'=>'zapatos','price'=>35900],
            ['title'=>'Zapatillas Azules','file'=>'demo/zapatos1.png','cat'=>'zapatos','price'=>32900],
            ['title'=>'Zapatillas Rojas 2','file'=>'demo/zapatos2.png','cat'=>'zapatos','price'=>34900],
        ]);

        foreach ($files as $f) {
            $p = Product::updateOrCreate(
                ['store_id'=>$store->id,'title'=>$f['title']],
                [
                    'description'=>Str::ucfirst($f['cat']).' KIVIC de la demo.',
                    'price'=>$f['price'],
                    'active'=>true,
                ]
            );
            ProductImage::firstOrCreate(
                ['product_id'=>$p->id,'url'=>'assets/'.$f['file']],
                ['position'=>1]
            );
        }
    }
}
