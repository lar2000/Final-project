<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Customer::query();

        if ($search) {
            $query->where('firstName', 'like', "%{$search}%")
                  ->orWhere('lastName', 'like', "%{$search}%");
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|in:ຊາຍ,ຍິງ,ອື່ນໆ',
            'phoneNumber' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json($customer);
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'gender' => 'required|in:ຊາຍ,ຍິງ,ອື່ນໆ',
        'phoneNumber' => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $customer = Customer::find($id);

    if (!$customer) {
        return response()->json(['message' => 'Customer not found'], 404);
    }

    $customer->update($request->all());

    return response()->json($customer);
}


public function destroy($id)
{
    $customer = Customer::find($id);

    if (!$customer) {
        return response()->json(['message' => 'Customer not found'], 404);
    }

    $customer->delete();

    return response()->json(['message' => 'Customer deleted successfully']);
}

}
