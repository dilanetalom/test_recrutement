<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = ['likeable_id', 'likeable_type', 'user_id'];

    public function post()
    {
        return $this->morphTo(Post::class, 'likeable');
    }

    public function beat()
    {
        return $this->morphTo(Beat::class, 'likeable');
    }

    public function user()
    {
        return $this->morphTo(User::class, 'likeable');
    }

    
}
