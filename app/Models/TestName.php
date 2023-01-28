<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
