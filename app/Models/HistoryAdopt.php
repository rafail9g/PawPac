<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAdopt extends Model
{
    protected $table = 'history_adopt';

    protected $fillable = [
        'adopsi_id',
        'catatan',
        'status'
    ];

    public function adopsi()
    {
        return $this->belongsTo(Adoption::class);
    }


}

