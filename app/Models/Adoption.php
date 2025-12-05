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

    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'kucing_id');
    }

    public function adopter()
    {
        return $this->belongsTo(Pengguna::class, 'adopter_id');
    }

    public function histories()
    {
        return $this->hasMany(HistoryAdopt::class, 'adopsi_id');
    }
}
