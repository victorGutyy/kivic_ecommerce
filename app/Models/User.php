<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que pueden asignarse en masa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Ocultar para serialización.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Tiendas que el usuario OWNEA (es dueño).
     */
    public function ownedStores()
    {
        return $this->hasMany(Store::class, 'owner_id');
    }

    /**
     * Tiendas donde el usuario es colaborador.
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class)
            ->withTimestamps()
            ->withPivot('role'); // admin, staff, viewer, etc.
    }

    /**
     * Devuelve todas las tiendas a las que el usuario tiene acceso
     * (propias + colaborador).
     */
    public function allStores()
    {
        return $this->ownedStores->merge($this->stores);
    }
}
