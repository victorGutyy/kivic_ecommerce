<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    protected $fillable = ['product_id','url','position'];

    public function product(){ return $this->belongsTo(Product::class); }

    // URL pública normalizada
    public function getSrcAttribute(): string
    {
        $u = $this->url ?? '';

        // Absoluta (http/https): úsala tal cual
        if (Str::startsWith($u, ['http://','https://'])) {
            return $u;
        }

        // Limpia prefijos accidentales
        $u = ltrim(preg_replace('#^public/#', '', $u), '/');

        // Si no empieza por assets/, asumimos que guardaste solo el nombre del archivo
        if (!Str::startsWith($u, 'assets/')) {
            $u = 'assets/demo/' . $u;
        }

        // Devuelve SIEMPRE una URL absoluta del dominio
        return asset($u); // => /assets/...
    }
}
