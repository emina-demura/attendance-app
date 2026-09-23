<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'type',
        'new_time',
        'new_note',
    ];

    protected $table = 'correction_requests';

    public function attendances()
    {
        return $this->belongsTo(Attendance::class);
    }
}
