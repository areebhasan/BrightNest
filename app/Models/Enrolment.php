<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrolment extends Model
{
    protected $fillable = [
        'child_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}