<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\MockObject\Builder\Stub;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'year',
        'semester',
        'program',
        'degree_level',
        'type',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'section_course');
    }
}


