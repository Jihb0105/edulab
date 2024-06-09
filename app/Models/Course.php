<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Rating;
use Carbon\Carbon;
class Course extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'title',
        'course_image',
        'instructor_id',
        'category_id',
        'hours',
        'minutes',
        'course_overview'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function chapters()
    {
        return $this->hasMany(chapter::class);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function enrollments()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id');
    }

    public function watchlists()
    {
        return $this->belongsToMany(User::class, 'watchlists');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
