<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'license_number',
        'phone_no',
        'area',
        'address'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class,);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
