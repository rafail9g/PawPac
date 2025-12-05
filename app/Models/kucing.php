<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kucing extends Model
{
    /** @use HasFactory<\Database\Factories\KucingFactory> */
    use HasFactory;
    protected $table = 'kucing';

    protected $fillable = [
        'provider_id',
        'name',
        'age',
        'breed',
        'description',
        'image',
        'status',
    ];

    public function provider()
    {
        return $this->belongsTo(Pengguna::class, 'provider_id');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'kucing_id');
    }
}
