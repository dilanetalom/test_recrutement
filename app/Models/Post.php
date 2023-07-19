<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['slug,content'];

    public function user()
    {
        return $this->morphedByMany(User::class, 'likeable');
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
}
