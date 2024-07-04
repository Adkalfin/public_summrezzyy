<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcnController extends Controller
{
    public function index()
    {
        $ecn = DB::table('ecn')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')
        ->paginate(10);
        return view('admin.ecn.index', compact('ecn'));
    }

    public function create()
    {
        $employees = DB::table('employees')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $companies = DB::table('companies')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $positions = DB::table('positions')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $ecn_masters = DB::table('ecn_masters')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        return view('admin.ecn.create', compact('employees', 'companies', 'positions', 'ecn_masters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'company_id' => 'required',
            'position_id' => 'required',
            'ecn_master_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

       $data = [
            'employee_id' => $request->employee_id,
            'company_id' => $request->company_id,
            'position_id' => $request->position_id,
            'ecn_master_id' => $request->ecn_master_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // dd($data);
        DB::table('ecn')->insert($data);

        return redirect()->route('ecn.index')->with('success', 'ECN created successfully.');
    }

    public function edit($id)
    {
        $ecn = DB::table('ecn')->where('id', $id)->first();
        $employees = DB::table('employees')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $companies = DB::table('companies')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $positions = DB::table('positions')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        $ecn_masters = DB::table('ecn_masters')->where('is_active', 1)->where('is_delete', 0)->orderBy('id', 'asc')->get();
        return view('admin.ecn.edit', compact('ecn', 'employees', 'companies', 'positions', 'ecn_masters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required',
            'company_id' => 'required',
            'position_id' => 'required',
            'ecn_master_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $data = [
            'employee_id' => $request->employee_id,
            'company_id' => $request->company_id,
            'position_id' => $request->position_id,
            'ecn_master_id' => $request->ecn_master_id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'updated_at' => now(),
        ];

        DB::table('ecn')->where('id', $id)->update($data);

        return redirect()->route('ecn.index')->with('success', 'ECN updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('ecn')->where('id', $id)->update(['is_delete' => 1]);

        return redirect()->route('ecn.index')->with('success', 'ECN deleted successfully.');
    }

    public function show($id)
    {
        $ecn = DB::table('ecn')->where('id', $id)->first();
        return view('admin.ecn.show', compact('ecn'));
    }
}
