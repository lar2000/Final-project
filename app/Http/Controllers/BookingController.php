<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Fetch all bookings
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $bookings = Booking::where('book_id', 'like', "%$search%")
            ->orWhere('cust_id', 'like', "%$search%")
            ->orWhere('room_number', 'like', "%$search%")
            ->orWhere('book_date', 'like', "%$search%")
            ->orWhere('book_enddate', 'like', "%$search%")
            ->orWhere('book_pay', 'like', "%$search%")
            ->get();

        return response()->json($bookings);
    }

    // Store a new booking
    public function store(Request $request)
    {
        $request->validate([
            'book_date' => 'required|date',
            'book_enddate' => 'required|date',
            'room_number' => 'required|string',
            'cust_id' => 'required|integer',
            'book_pay' => 'required|integer',
        ]);

        $booking = Booking::create($request->all());

        return response()->json($booking, 201);
    }

    // Fetch a single booking
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return response()->json($booking);
    }

    // Update a booking
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_date' => 'required|date',
            'book_enddate' => 'required|date',
            'room_number' => 'required|string',
            'cust_id' => 'required|integer',
            'book_pay' => 'required|integer',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return response()->json($booking);
    }

    // Delete a booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(null, 204);
    }
}
