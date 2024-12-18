<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',        // ID kamar
        'power_status',   // Status listrik (on/off)
        'timestamp'       // Waktu perubahan status listrik
    ];
}
