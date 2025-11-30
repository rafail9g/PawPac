<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
        'living_environment'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'adopter_id');
    }

    public function kucingProvider()
    {
        return $this->hasMany(Kucing::class, 'provider_id');
    }
}
