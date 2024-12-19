<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Import HasApiTokens

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; // Tambahkan HasApiTokens

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];
}
