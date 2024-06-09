<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\LectureType;
use App\Models\Resource;
use App\Models\Question;
use App\Models\User;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'chapter_no',
        'course_id',
        'lecture_type_id',
        'title',
        'overview',
        'lecture',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectureType()
    {
        return $this->belongsTo(LectureType::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
