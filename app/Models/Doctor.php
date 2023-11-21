<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'spcecialty',
        'qualification'
    ];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }

    public function fees($hospital_id)
    {
        $cost = DB::select("SELECT fees FROM doctor_hospital WHERE hospital_id=$hospital_id AND doctor_id=$this->id");

        return $cost[0]->fees;
    }
}
