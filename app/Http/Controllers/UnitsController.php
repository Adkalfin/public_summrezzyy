<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function index()
    {
        $units = DB::table('units as u1')
            ->leftJoin('units as u2', 'u1.units_id_parents', '=', 'u2.id')
            ->select('u1.*', 'u2.name as parent_name')
            ->where('u1.is_active', 1)
            ->where('u1.is_delete', 0)
            ->orderBy('u1.id', 'asc')
            ->paginate(10);

        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        $units = DB::table('units')->where('is_active', 1)->where('is_delete', 0)
        ->orderBy('id', 'asc')
        ->paginate(5);
        return view('admin.units.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::table('units')->insert([
            'name' => $request->name,
            'units_id_parent' => $request->units_id_parent,
            'is_active' => 1,
            'is_deleted' => 0,
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit created successfully.');
    }

    public function edit($id)
    {
        $unit = DB::table('units')->where('id', $id)->first();
        $parents = DB::table('units')->where('is_active', 1)->where('is_delete', 0)->get();
        return view('admin.units.edit', compact('unit', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::table('units')->where('id', $id)->update([
            'name' => $request->name,
            'units_id_parent' => $request->units_id_parent,
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit updated successfully');
    }

    public function destroy($id)
    {
        DB::table('units')->where('id', $id)->update([
            'is_delete' => 1,
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit deleted successfully');
    }
}
