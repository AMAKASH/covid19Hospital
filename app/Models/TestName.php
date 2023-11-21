<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function cost($hospital_id)
    {
        $cost = DB::select("SELECT cost FROM hospital_test_name WHERE hospital_id=$hospital_id AND test_name_id=$this->id");

        return $cost[0]->cost;
    }
}
