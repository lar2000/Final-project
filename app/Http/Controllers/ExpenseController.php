<?php

// app/Http/Controllers/ExpenseController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Validator;

class ExpenseController extends Controller
{
    // Fetch all expenses with optional search filter
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Expense::query();
        
        if ($search) {
            $query->where('user_id', 'like', "%{$search}%")
                  ->orWhere('expen_date', 'like', "%{$search}%")
                  ->orWhere('expen_detail', 'like', "%{$search}%")
                  ->orWhere('total_price', 'like', "%{$search}%");
        }

        return response()->json($query->get());
    }

    // Store a new expense
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'expen_date' => 'required|date',
            'expen_detail' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $expense = Expense::create($request->all());

        return response()->json(['message' => 'Expense created successfully!', 'expense' => $expense], 201);
    }

    // Fetch a single expense by ID
    public function show($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        return response()->json($expense);
    }

    // Update an existing expense
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'expen_date' => 'required|date',
            'expen_detail' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        $expense->update($request->all());

        return response()->json(['message' => 'Expense updated successfully!', 'expense' => $expense]);
    }

    // Delete an expense
    public function destroy($id)
    {
        $expense = Expense::find($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully!']);
    }
}
