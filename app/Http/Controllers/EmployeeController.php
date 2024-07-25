<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Import the Employee model

class EmployeeController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function store(Request $request)
    {
        $employeeId = $request->id;

        $employee = Employee::updateOrCreate(
            [
                'id' => $employeeId
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address
            ]
        );

        return response()->json($employee);
    }
}
