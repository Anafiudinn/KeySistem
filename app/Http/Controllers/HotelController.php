<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Card;
use App\Models\PowerUsage;
use App\Models\AccessLog;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function checkIn(Request $request)
    {
        // Simulasi check-in dan pemberian kartu kunci
        $room = Room::where('room_number', $request->room_number)->first();
        if (!$room) {
            return response()->json(['status' => 'error', 'message' => 'Room not found'], 404);
        }

        $card = Card::create([
            'card_id' => uniqid('card_'),
            'room_id' => $room->id
        ]);

        return response()->json(['status' => 'success', 'message' => 'Check-in successful, key card assigned', 'card_id' => $card->card_id]);
    }

    public function authenticateCard(Request $request)
    {
        $request->validate([
            'room_number' => 'required|exists:rooms,room_number',
            'card_id' => 'required|exists:cards,card_id',
        ]);
    
        $card = Card::where('card_id', $request->card_id)
            ->where('is_blocked', false) // Pastikan kartu tidak diblokir
            ->whereHas('room', function ($query) use ($request) {
                $query->where('room_number', $request->room_number);
            })
            ->first();
    
        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid card or room',
            ], 404);
        }
    
        AccessLog::create([
            'room_id' => $card->room_id,
            'action' => 'door unlocked',
            'timestamp' => now(),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Access diterima',
            'door_status' => 'pintu unlocked',
            'timestamp' => now()
        ]);
    }

    public function controlPower(Request $request)
    {
        $request->validate([
            'room_number' => 'required|exists:rooms,room_number',
            'card_id' => 'required|exists:cards,card_id',
            'action' => 'required|in:turn_on',
        ]);

        $room = Room::where('room_number', $request->room_number)->first();
        $card = Card::where('card_id', $request->card_id)->where('room_id', $room->id)->first();

        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid card for this room',
            ], 404);
        }

        $status = 'on';

        PowerUsage::create([
            'room_id' => $room->id,
            'power_status' => $status,
            
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Power turned on',
            'lights_status' => $status,
            'ac_status' => 'on',
            'timestamp' => now()
        ]);
    }

    public function deactivatePower(Request $request)
    {
        $request->validate([
            'room_number' => 'required|exists:rooms,room_number',
            'card_id' => 'required|exists:cards,card_id',
            'action' => 'required|in:turn_off',
        ]);

        $room = Room::where('room_number', $request->room_number)->first();
        $card = Card::where('card_id', $request->card_id)->where('room_id', $room->id)->first();

        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid card for this room',
            ], 404);
        }

        $status = 'off';

        PowerUsage::create([
            'room_id' => $room->id,
            'power_status' => $status,
            
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Power turned off',
            'lights_status' => $status,
            'ac_status' => 'off',
            'timestamp' => now()
        ]);
    }
    public function accessHistory(Request $request)
    {
        $room = Room::where('room_number', $request->room_number)->first();

        if (!$room) {
            return response()->json(['status' => 'error', 'message' => 'Room not found'], 404);
        }

        $logs = AccessLog::where('room_id', $room->id)
            ->whereDate('timestamp', $request->date)
            ->get();

        if ($logs->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No access logs found for the specified date'], 404);
        }

        return response()->json([
            'status' => 'success',
            'room_number' => $request->room_number,
            'date' => $request->date,
            'access_logs' => $logs
        ]);
    }
    public function blockCard(Request $request)
    {
        $request->validate([
            'room_number' => 'required|exists:rooms,room_number',
            'card_id' => 'required|exists:cards,card_id',
        ]);
    
        // Cek apakah kartu terkait dengan room_number
        $card = Card::where('card_id', $request->card_id)
            ->whereHas('room', function ($query) use ($request) {
                $query->where('room_number', $request->room_number);
            })
            ->first();
    
        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'Card is not associated with the specified room',
            ], 404);
        }
    
        // Blokir kartu
        $card->update(['is_blocked' => true]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Card telah diblokir',
            'card_id' => $card->card_id,
        ]);
    }
    
}
