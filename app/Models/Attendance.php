<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'service_id',
        'child_id',
        'room_id',
        'attendance_date',
        'check_in',
        'check_out',
        'status',
        'marked_by_staff_id',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function markedByStaff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'marked_by_staff_id');
    }
}