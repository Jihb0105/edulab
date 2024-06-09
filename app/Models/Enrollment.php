<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'course_id',
        'student_id',
        'enrollment_date'
    ];

    public function students()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
