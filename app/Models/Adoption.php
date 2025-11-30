<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\History;
use App\Models\Kucing;
use App\Models\Pengguna;
class Adoption extends Model
{
    use HasFactory;

    protected $table = 'adopsi';

    protected $fillable = [
        'adopter_id',
        'kucing_id',
        'nilai_quiz',
        'status'
    ];

    public function jawaban()
    {
        return $this->hasMany(QuizJawaban::class, 'adopsi_id');
    }

    // Relasi: Adoption dimiliki oleh satu kucing
    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'kucing_id');
    }

    // Relasi: Adoption dimiliki oleh satu adopter
    public function adopter()
    {
        return $this->belongsTo(Pengguna::class, 'adopter_id');
    }

    // Relasi: Adoption memiliki banyak history
    public function histories()
    {
        return $this->hasMany(HistoryAdopt::class, 'adopsi_id');
    }
}
