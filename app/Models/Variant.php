<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Variant extends Model {
use HasFactory;
protected $fillable = ['product_id','sku','size','color','price','stock'];
public function product(){ return $this->belongsTo(Product::class); }
}