<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSoal extends Model
{
    protected $table = 'quiz_soal';

    protected $fillable = [
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'tipe',
        'jawaban_benar',
        'tipe_soal',
    ];

    public function jawaban()
    {
        return $this->hasMany(QuizJawaban::class, 'soal_id');
    }
}
