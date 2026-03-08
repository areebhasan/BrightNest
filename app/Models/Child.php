<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'room_name',
        'status',
    ];

    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class);
    }
}