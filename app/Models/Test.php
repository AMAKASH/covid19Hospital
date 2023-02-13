<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $guarded = [];

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

    public function age()
    {
        $days = now()->diffInDays(Carbon::parse($this->attributes['dob']));
        $months = intdiv($days, 30);
        $days = $days % 30;
        $years = intdiv($months, 12);
        $months = $months % 12;

        $tobereturned = "";
        if ($years > 0) {
            $tobereturned .= "$years Y";
        }
        if ($months > 0) {
            $tobereturned .= "$months M";
        }
        if ($days > 0) {
            $tobereturned .= "$days D";
        }

        return $tobereturned;
    }
}
