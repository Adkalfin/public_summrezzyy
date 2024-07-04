<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Positions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jabatans_id',
        'units_id',
        'positions_id_parent',
        'is_active',
        'is_delete',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatans::class, 'jabatans_id');
    }

    public function unit()
    {
        return $this->belongsTo(Units::class, 'units_id');
    }

    public function parentPosition()
    {
        return $this->belongsTo(Positions::class, 'positions_id_parent');
    }

}
