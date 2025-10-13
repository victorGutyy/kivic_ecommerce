<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Store extends Model {
use HasFactory;
protected $fillable = ['owner_id','name','slug','country','currency'];
public function owner(){ return $this->belongsTo(User::class, 'owner_id'); }
public function users(){ return $this->belongsToMany(User::class)->withTimestamps()->withPivot('role'); }
public function products(){ return $this->hasMany(Product::class); }
}