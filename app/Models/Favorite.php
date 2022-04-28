<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['job_id'];

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
