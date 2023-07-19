<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    use HasFactory;

    protected $fillable = ['slug,title,free_file,premuim_file'];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
