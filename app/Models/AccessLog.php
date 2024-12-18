<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',         // Kolom yang diizinkan untuk mass assignment
        'action',          // Jenis aksi (door unlocked/locked)
        'power_status',    // Status daya (on/off)
        'timestamp'        // Waktu akses
    ];
}
