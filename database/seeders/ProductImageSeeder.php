<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['product_id'=>1,'url'=>'playera1.png','position'=>1],
            ['product_id'=>2,'url'=>'playera2.png','position'=>1],
            ['product_id'=>3,'url'=>'pantalon.png','position'=>1],
            ['product_id'=>4,'url'=>'pantalon2.png','position'=>1],
            ['product_id'=>5,'url'=>'zapatos1.png','position'=>1],
            ['product_id'=>6,'url'=>'zapatos2.png','position'=>1],
            ['product_id'=>7,'url'=>'mochila1.png','position'=>1],
            ['product_id'=>8,'url'=>'mochila2.png','position'=>1],
            ['product_id'=>9,'url'=>'gorras.png','position'=>1],
            ['product_id'=>10,'url'=>'gorras1.png','position'=>1],
        ];

        foreach ($rows as $r) {
            ProductImage::updateOrCreate(
                ['product_id'=>$r['product_id'],'position'=>$r['position']],
                ['url'=>$r['url']]
            );
        }
    }
}
