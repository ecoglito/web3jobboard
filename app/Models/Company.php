<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function job()
    {
        // albums.artist_id is the foregin key column
        return $this->hasMany(Job::class);
    }
}
