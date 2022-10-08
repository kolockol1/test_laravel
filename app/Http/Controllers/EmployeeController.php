<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'=>'required',
            'position'=>'required',
            'superior_id'=>'required',
            'start_date'=>'required',
        ]);
        // Getting values from the blade template form
        $employee = new Employee([
            'name' => $request->get('name'),
            'position' => $request->get('position'),
            'superiorId' => $request->get('superior_id'),
            'startDate' => $request->get('start_date')
        ]);
        $employee->save();
        return redirect('/employees')->with('success', 'Employee saved.');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $employee = Employee::find($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'name'=>'required',
            'position'=>'required',
            'superior_id'=>'required',
            'start_date'=>'required',
        ]);
        $employee = Employee::find($id);
        $employee->name =  $request->get('name');
        $employee->position = $request->get('position');
        $employee->superiorId = $request->get('superior_id');
        $employee->startDate = $request->get('start_date');
        if (!empty($request->get('end_date'))) {
            $employee->endDate = $request->get('end_date');
        }
        $employee->save();

        return redirect('/employee')->with('success', 'Employee updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/employees')->with('success', 'Employee removed.');
    }
}
