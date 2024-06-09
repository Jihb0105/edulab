<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Course;
use App\Models\JobTitle;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'birth_date',
        'type',
        'description',
        'approved',
        'lecturer_description',
        'lecturer_cv'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["student", "admin", "lecturer"][$value],
        );
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function jobTitles()
    {
        return $this->hasMany(JobTitle::class);
    }

    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'course_id', 'student_id');
    }

    public function watchlists()
    {
        return $this->belongsToMany(Course::class, 'watchlists');
    }
}
