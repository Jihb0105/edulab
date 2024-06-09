<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;

class Resource extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'chapter_id',
        'resource',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
