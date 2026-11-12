<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'attendance_id',
        // 'type',
        // 'new_time',
        // 'new_note',
        'staff_id',
        'status_id',
        'event_at',
    ];

    protected $table = 'attendances';

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function correction_requests(): HasMany
    {
        return $this->hasMany(CorrectionRequest::class);
    }
}
