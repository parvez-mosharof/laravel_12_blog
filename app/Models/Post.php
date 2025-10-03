<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'post_title',
        'description',
        'image',
        'user_name',
        'user_id',
    ];

    // Comments relationship
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // User relationship (who created the post)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

