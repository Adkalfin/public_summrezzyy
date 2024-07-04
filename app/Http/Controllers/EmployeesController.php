<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::where('is_delete', 0)->where('is_active', 1)
        ->orderBy('id', 'asc')
        ->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create() {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',

        ]);
        Employee::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'status' => $request->status,
            'is_delete' => 0,
            'is_active' => 1,
        ]);
        return redirect()->route('employees.index')->with('success','Employee created successfuly');
    }

    public function edit($id)
    {
        $employees = Employee::find($id);
        return view('admin.employees.edit', compact('employees'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',

        ]);
        $employee->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'birthplace' => $request->birthplace,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'status' => $request->status,

        ]);
        return redirect()->route('employees.index')->with('success','Employee updated successfuly');
    }

    public function destroy(Employee $employee)
    {
        $employee->is_delete = 1;
        $employee->save();
        return redirect()->route('employees.index')->with('success','Employee deleted successfuly');
    }
}
