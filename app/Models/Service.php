<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'service_code',
        'provider_name',
        'email',
        'phone',
        'address_line_1',
        'suburb',
        'state',
        'postcode',
        'daily_fee',
        'opening_time',
        'closing_time',
        'capacity',
        'status',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function children()
    {
        return $this->hasMany(Child::class);
    }
    public function enrolments()
    {
        return $this->hasMany(Enrolment::class);
    }
    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('access_role', 'status')
            ->withTimestamps();
    }                        
}