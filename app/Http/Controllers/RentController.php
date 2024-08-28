<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        return response()->json(Rent::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|integer',
            'room_number' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'cust_id' => 'required|integer',
            'room_price' => 'required|numeric'
        ]);

        $rent = Rent::create($validated);

        return response()->json($rent, 201);
    }

    public function show($id)
    {
        $rent = Rent::find($id);

        if (!$rent) {
            return response()->json(['message' => 'Rent not found'], 404);
        }

        return response()->json($rent);
    }

    public function update(Request $request, $id)
    {
        $rent = Rent::find($id);

        if (!$rent) {
            return response()->json(['message' => 'Rent not found'], 404);
        }

        $validated = $request->validate([
            'book_id' => 'required|integer',
            'room_number' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'cust_id' => 'required|integer',
            'room_price' => 'required|numeric'
        ]);

        $rent->update($validated);

        return response()->json($rent);
    }

    // In app/Http/Controllers/RentController.php
public function destroy($id)
{
    $rent = Rent::find($id);

    if ($rent) {
        $rent->delete();
        return response()->json(['message' => 'Rent record deleted successfully.'], 200);
    } else {
        return response()->json(['message' => 'Rent record not found.'], 404);
    }
}

}
