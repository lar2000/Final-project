<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->query('search');
            $roomtypes = RoomType::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('roomtype_id', 'like', "%{$search}%")
                          ->orWhere('roomtype_name', 'like', "%{$search}%");
                })
                ->get();

            return response()->json($roomtypes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch roomtypes.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'roomtype_id' => 'required|integer|unique:roomtypes,roomtype_id',
            'roomtype_name' => 'required|string|max:255',
            'room_price' => 'required|integer',
        ]);

        try {
            $roomtype = RoomType::create($validated);
            return response()->json(['message' => 'RoomType added successfully!', 'roomtype' => $roomtype], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to add roomtype.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomtype): JsonResponse
    {
        return response()->json($roomtype);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roomtype $roomtype): JsonResponse
    {
        $validatedData = $request->validate([
            'roomtype_id' => 'required|integer',
            'roomtype_name' => 'required|string|max:255',
            'room_price' => 'required|numeric',
        ]);

        $roomtype->update($validatedData);

        return response()->json(['message' => 'Room type updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomtype): JsonResponse
    {
        try {
            $roomtype->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete roomtype.'], 500);
        }
    }
}
