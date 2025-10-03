<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Columns that can be mass-assigned
    protected $fillable = [
        'post_id',
        'author_name',
        'content',
    ];

    // Relationship: a Comment belongs to a Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
