<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrolment extends Model
{
    protected $fillable = [
        'service_id',
        'child_id',
        'room_id',
        'start_date',
        'end_date',
        'status',
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}