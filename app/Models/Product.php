<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model {
use HasFactory;
protected $fillable = ['store_id','title','description','price','active'];
public function store(){ return $this->belongsTo(Store::class); }
public function variants(){ return $this->hasMany(Variant::class); }
public function images(){ return $this->hasMany(ProductImage::class); }
}