<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'job_titles'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
