<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hospital_id',
        'test_name_id',
        'test_report_path'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testName()
    {
        return $this->belongsTo(TestName::class);
    }
}
