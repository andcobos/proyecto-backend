<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'rol_id',
        'name',
        'lastname',
        'email',
        'address',
        'password',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function getDefaultGuardName(): string
    {
        return 'api';
    }

    // Relación Rol
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación Seller (Si un usuario es un vendedor)
    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'user_id');
    }

    // Verificar si el usuario es un vendedor
    public function isSeller(): bool
    {
        return $this->seller()->exists();
    }

    // Verificar si el usuario es un admin
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
