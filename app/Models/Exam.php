<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'course_id',
        'created_by',
        'total_questions',
        'total_marks',
        'passing_score',
        'duration',
        'start_time',
        'end_time',
        'approval_status',
        'is_active',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluator::class, 'exam_reviews',)->withPivot(['id', 'review', 'approved', 'created_at']);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function statuses()
    {
        return $this->hasMany(ExamStatus::class);
    }
}
