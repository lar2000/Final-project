<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'phoneNumber' => 'required|string|max:20'
        ]);

        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'phoneNumber' => 'required|string|max:20'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);
        return response()->json($customer, 200);
    }

    public function destroy($id)
    {
        \Log::info('Deleting customer with ID: ' . $id); // Log the ID
    
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully']);
        } catch (ModelNotFoundException $e) {
            \Log::error('Customer not found: ' . $e->getMessage());
            return response()->json(['message' => 'Customer not found'], 404);
        } catch (\Exception $e) {
            \Log::error('Failed to delete Customer: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete Customer', 'error' => $e->getMessage()], 500);
        }
    }
    


}
