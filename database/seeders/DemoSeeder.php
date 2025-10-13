<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{User, Store, Product, Variant};
use Illuminate\Support\Str;


class DemoSeeder extends Seeder {
public function run(): void {
$user = User::firstOrCreate(
['email' => 'admin@kivic.local'],
['name' => 'Admin KIVIC','password' => bcrypt('password')]
);
$store = Store::create([
'owner_id' => $user->id,
'name' => 'Moda Básica',
'slug' => 'moda-basica',
'country' => 'CO','currency' => 'COP'
]);
$store->users()->attach($user->id, ['role' => 'owner']);


$product = Product::create([
'store_id'=>$store->id,
'title'=>'Camiseta Unisex',
'description'=>'Algodón, varias tallas y colores',
'price'=>35000,
'active'=>true
]);
foreach ([['S','Blanco'],['M','Negro'],['L','Azul']] as [$size,$color]){
Variant::create([
'product_id'=>$product->id,
'sku'=> Str::upper(Str::random(8)),
'size'=>$size,
'color'=>$color,
'price'=>35000,
'stock'=>10
]);
}
}
}
