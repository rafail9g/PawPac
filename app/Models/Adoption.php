<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ⬇ Tambahkan ini di sini
use App\Models\Kucing;
use App\Models\Pengguna;   // atau User kalau model user kamu namanya User

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

    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'kucing_id');
    }

    public function adopter()
    {
        return $this->belongsTo(Pengguna::class, 'adopter_id');

    }
}
