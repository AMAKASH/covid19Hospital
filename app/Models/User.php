<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'nid_number',
        'phone_number',
        'covid_vaccination_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function tests()
    {
        return $this->hasMany('App\Models\Test');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

    public function hospital()
    {
        return $this->hasOne('App\Models\Hospital');
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = $value . (User::all()->count() + 1);
    }

    public function registered_vac_hospital()
    {
        $hos_id = $this->registered_vac_hospital;
        $hos = Hospital::find($hos_id);
        if ($hos == null) {
            return new Hospital(['name' => "Not Registered"]);
        } else {
            return $hos;
        }
    }
}
