<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_id',
        'user_id',
        'post_id',
        'title',
        'content',
        'is_op',
    ];

    protected $appends = [
        'last_reply',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function getIsOpAttribute($value)
    {
        return (bool) $value;
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::create($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::create($value)->diffForHumans();
    }

    public function getLastReplyAttribute()
    {
        return $this->replies()->latest()->first();
    }
}
