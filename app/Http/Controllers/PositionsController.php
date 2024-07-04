<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Positions;

class PositionsController extends Controller
{
    public function index()
    {
        $positions = DB::table('positions as p')
            ->leftJoin('jabatans as j', 'p.jabatans_id', '=', 'j.id')
            ->leftJoin('units as u', 'p.units_id', '=', 'u.id')
            ->leftJoin('positions as pu', 'p.positions_id_parent', '=', 'pu.id')
            ->select(
                'p.id as id',
                'p.name as position_name',
                'j.name as jabatan_name',
                'u.name as unit_name',
                'pu.name as parent_name',
            )->orderBy('p.id', 'asc')
            ->paginate(10);
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        $jabatans = DB::table('jabatans')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        $units = DB::table('units')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        $positions = DB::table('positions')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        return view('admin.positions.create', compact('jabatans', 'units', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        $data = [
            'name'=> $request->name,
            'jabatans_id'=> (int) $request->jabatans_id,
            'units_id'=> (int) $request->units_id,
            'positions_id_parent'=> (int) $request->positions_id_parent,
            'is_active'=> 1,
            'is_delete'=> 0,
        ];

        Positions::create($data);

        return redirect()->route('positions.index')
            ->with('success', 'Position created successfully.');
    }

    public function edit($id)
    {
        $position = Positions::with(['jabatan', 'unit', 'parentPosition'])->where('id', $id)->first();
        $jabatans = DB::table('jabatans')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        $units = DB::table('units')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        $positions = DB::table('positions')->where('is_active', 1)->where('is_delete', 0)->paginate(5);
        return view('admin.positions.edit', compact('positions', 'jabatans', 'units', 'position'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'jabatans_id' => 'required',
            'units_id' => 'required',
            'positions_id_parent' => 'required',
        ]);

        $data =[
            'name'=> $request->name,
            'jabatans_id'=> (int) $request->jabatans_id,
            'units_id'=> (int) $request->units_id,
            'positions_id_parent'=> (int) $request->positions_id_parent,
        ];

        Positions::where('id', $id)->update($data);

        return redirect()->route('positions.index')
            ->with('success', 'Position updated successfully');
    }

    public function destroy($id)
    {
        DB::table('positions')->where('id', $id)->update([
            'is_delete' => 1,
        ]);

        return redirect()->route('positions.index')
            ->with('success', 'Position deleted successfully');
    }
}
