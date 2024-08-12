<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Rent;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getExpenses()
    {
        $total = Expense::sum('total_price');
        return response()->json(['total' => $total]);
    }

    public function getRents()
    {
        $total = Rent::sum('room_price');
        return response()->json(['total' => $total]);
    }

    public function getPayments()
    {
        $total = Payment::sum('room_price');
        return response()->json(['total' => $total]);
    }
}

