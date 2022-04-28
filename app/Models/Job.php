<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function comment() {
        return $this->hasMany(Comments::class);
    }

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }
}
