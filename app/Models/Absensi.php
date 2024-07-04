<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'date',
        'check_in',
        'check_out',
        'latlong_in',
        'latlong_out',
        'status',
        'employees_id',
        'schedules_id',
    ];
    // Define relationship with Schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedules_id');
    }
}