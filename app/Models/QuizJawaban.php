<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizJawaban extends Model
{
    protected $table = 'quiz_jawaban';

    protected $fillable = [
        'adopsi_id',
        'soal_id',
        'jawaban',
        'is_correct'
    ];

    public function soal()
    {
        return $this->belongsTo(QuizSoal::class, 'soal_id');
    }

    public function adopsi()
    {
        return $this->belongsTo(Adoption::class, 'adopsi_id');
    }
}
