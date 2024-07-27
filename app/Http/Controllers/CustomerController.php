<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->query('search');
            $customers = Customer::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('cust_id', 'like', "%{$search}%");
                })
                ->get();

            return response()->json($customers);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch customers.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cust_id' => 'required|integer|max:10|unique:customers,cust_id',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'required|string',
            'phoneNumber' => 'required|integer',
        ]);

        try {
            $customer = Customer::create($validated);
            return response()->json(['message' => 'Customer added successfully!', 'customer' => $customer], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to add customer.'], 500);
        }
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }

    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validated = $request->validate([
            'cust_id' => 'required|integer|max:10|unique:customers,cust_id,' . $customer->id,
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'required|string',
            'phoneNumber' => 'required|integer',
        ]);

        try {
            $customer->update($validated);
            return response()->json(['message' => 'Customer updated successfully!', 'customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to update customer.'], 500);
        }
    }

    public function destroy(Customer $customer): JsonResponse
    {
        try {
            $customer->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete customer.'], 500);
        }
    }
}
