<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->query('search');
            $rooms = Room::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('room_number', 'like', "%{$search}%");
                })
                ->get();

            return response()->json($rooms);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch rooms.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number',
            'roomtype_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        try {
            $room = Room::create($validated);
            return response()->json(['message' => 'Room added successfully!', 'room' => $room], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to add room.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): JsonResponse
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): JsonResponse
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255',
            'roomtype_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        try {
            $room->update($validated);
            return response()->json(['message' => 'Room updated successfully!', 'room' => $room]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to update room.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): JsonResponse
    {
        try {
            $room->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete room.'], 500);
        }
    }
}
