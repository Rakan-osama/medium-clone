<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'image',
        'category_id',
        'user_id',
        'published_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function readTime($wordsPerMinutes = 100)
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerMinutes);
        return max(1, $minutes);
    }

    public function imageUrl()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return null;
    }

}
