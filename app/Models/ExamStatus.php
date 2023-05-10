<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'student_id',
        'remaining_time',
        'started_at',
        'finished_at',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


}
