<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'path',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getPathAttribute($value)
    {
        if (str_starts_with($value, 'http')) {
            return $value;
        } else {
            return asset('storage/' . $value);
        }
    }
}
