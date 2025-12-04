<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoLokasi extends Model
{
    protected $table = 'info_lokasi';

    protected $fillable = [
        'alamat',
        'no_hp',
        'jam_buka',
        'jam_tutup',
    ];
}
