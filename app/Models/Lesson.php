<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'title',
        'slug',
        'description',
        'is_active',
        'is_premium',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lesson) {
            $lesson->slug = Str::slug($lesson->title);
        });
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
