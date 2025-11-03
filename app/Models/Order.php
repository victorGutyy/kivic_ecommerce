<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id','user_id','reference','status',
        'customer_name','email',
        'subtotal_cents','tax_cents','shipping_cents','total_cents','currency',
        'payment_gateway','payment_ref','paid_at','payment_payload',
    ];

    protected $casts = [
        'payment_payload' => 'array',
        'paid_at' => 'datetime',
    ];

    public function items(){ return $this->hasMany(OrderItem::class); }
    public function store(){ return $this->belongsTo(Store::class); }

    // Helpers
    public function getSubtotalFormattedAttribute(){ return '$ '.number_format(floor($this->subtotal_cents/100),0,',','.'); }
    public function getTaxFormattedAttribute(){ return '$ '.number_format(floor($this->tax_cents/100),0,',','.'); }
    public function getShippingFormattedAttribute(){ return '$ '.number_format(floor($this->shipping_cents/100),0,',','.'); }
    public function getTotalFormattedAttribute(){ return '$ '.number_format(floor($this->total_cents/100),0,',','.'); }
}
