<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function card()
    { 
        return $this->hasMany(Card::class);
    }

    public function powerUsage()
    {
        return $this->hasMany(PowerUsage::class);
    }

    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
     // Relasi: Room memiliki banyak kartu
     
}
