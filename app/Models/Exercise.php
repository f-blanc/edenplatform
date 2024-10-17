<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'directive',
        'initial_code',
        'expected_code',
        'is_active',
        'is_premium'
    ];

    /**
     * Get the lesson that owns the exercise
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
