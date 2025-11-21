<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Store extends Model {
use HasFactory;
protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'country',
        'currency',
        'brand_name',
        'industry',
        'phone',
        'whatsapp',
        'instagram',
        'city',
        'plan',
        'theme',
    ];

 public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Dueño de la tienda.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Usuarios con acceso a la tienda (colaboradores, etc.).
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('role');
    }

    /**
     * Productos de la tienda.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}