<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model {
use HasFactory;
protected $fillable = ['store_id','customer_id','status','subtotal','shipping','total','payment_status'];
public function items(){ return $this->hasMany(OrderItem::class); }
}