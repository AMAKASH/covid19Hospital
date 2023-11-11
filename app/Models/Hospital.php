<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class,);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function test_names()
    {
        return $this->belongsToMany(TestName::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function registered_patients()
    {
        return User::where('registered_vac_hospital', $this->id)->get();
    }
}
