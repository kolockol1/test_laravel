<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findBySuperior(Request $request): JsonResponse
    {
        $request->validate(['id' => 'required|numeric']);
        $employees = Employee::where('superiorId', $request->get('id'))->get();

        return response()->json([
            "employees" => $employees,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findByPosition(Request $request): JsonResponse
    {
        $request->validate(['position' => 'required|string']);
        $employees = Employee::where('position', $request->get('position'))->get();

        return response()->json([
            "employees" => $employees,
        ]);
    }
}
