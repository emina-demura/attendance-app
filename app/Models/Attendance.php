<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'type',
        'new_time',
        'new_note',
    ];

    protected $table = 'attendances';

    public function staffs()
    {
        return $this->belongsTo(Staff::class);
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class);
    }

    public function correction_requests(): HasMany
    {
        return $this->hasMany(CorrectionRequest::class);
    }
}
