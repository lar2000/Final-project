<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::all();
    }

   // Store a new payment
   public function store(Request $request)
   {
       $request->validate([
           'rent_id' => 'required|integer',
           'cust_id' => 'required|integer',
           'month_year' => 'required|date',
           'room_price' => 'required|numeric',
           'ele_price' => 'required|numeric',
           'water_price' => 'required|numeric',
           'gar_price' => 'required|numeric',
       ]);
   
       $payment = Payment::create($request->all());
   
       return response()->json($payment, 201);
   }
   
   public function update(Request $request, $id)
   {
       $payment = Payment::findOrFail($id);
   
       $request->validate([
           'rent_id' => 'required|integer',
           'cust_id' => 'required|integer',
           'month_year' => 'required|date',
           'room_price' => 'required|numeric',
           'ele_price' => 'required|numeric',
           'water_price' => 'required|numeric',
           'gar_price' => 'required|numeric',
       ]);
   
       $payment->update($request->all());
   
       return response()->json($payment);
   }
   

// Delete a payment
public function destroy($id)
{
    $payment = Payment::findOrFail($id);
    $payment->delete();

    return response()->json(null, 204);
}

}
