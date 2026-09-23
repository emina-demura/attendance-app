<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
    ];

    protected $table = 'statuses';

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
