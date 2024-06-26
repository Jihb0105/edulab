<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Category extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'title',
        'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
