<?php

// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function index()
    {
        return response()->json(Checkout::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rent_id' => 'required|exists:rents,rent_id',
            'room_number' => 'required|string',
            'cust_name' => 'required|string',
            'date_checkout' => 'required|date',
        ]);

        $checkout = Checkout::create($validated);

        return response()->json($checkout, 201);
    }

    public function show($id)
    {
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return response()->json(['error' => 'Checkout not found'], 404);
        }

        return response()->json($checkout);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'rent_id' => 'required|exists:rents,rent_id',
            'room_number' => 'required|string',
            'cust_name' => 'required|string',
            'date_checkout' => 'required|date',
        ]);

        $checkout = Checkout::find($id);

        if (!$checkout) {
            return response()->json(['error' => 'Checkout not found'], 404);
        }

        $checkout->update($validated);

        return response()->json($checkout);
    }

    public function destroy($id)
    {
        $checkout = Checkout::find($id);

        if (!$checkout) {
            return response()->json(['error' => 'Checkout not found'], 404);
        }

        $checkout->delete();

        return response()->json(['message' => 'Checkout deleted']);
    }
}
