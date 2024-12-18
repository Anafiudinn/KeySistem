<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'room_id' ,'is_blocked' ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
