<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    use HasFactory;
    protected $guarded = [];

    public function setAreaNameAttribute($value)
    {
        $this->attributes['area_name'] = strtolower($value);
    }
    public function getAreaNameAttribute($value)
    {
        return ucfirst($value);
    }
}
