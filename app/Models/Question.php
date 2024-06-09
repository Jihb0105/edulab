<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chapter;
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_no',
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer'
    ];

    public function chapter()
    {
        $this->belongsTo(Chapter::class);
    }
}
