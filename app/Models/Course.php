<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
        'course_code',
        'course_title',
        'credit_hour',
    ];
}
