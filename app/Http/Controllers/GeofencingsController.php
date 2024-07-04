<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeofencingsController extends Controller
{
    public function index()
    {
        $geofencings = DB::table('geofencings')->where('is_active', 1)->where('is_delete', 0)
        ->orderBy('id', 'asc')->paginate(10);
        return view('admin.geofencings.index', compact('geofencings'));
    }

    public function create()
    {
        return view('admin.geofencings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'address' => 'required',
        ]);

        DB::table('geofencings')->insert([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'address' => $request->address,
            'is_active' => 1,
            'is_delete' => 0,
        ]);

        return redirect()->route('geofencings.index')
            ->with('success', 'Geofencing created successfully.');
    }

    public function edit($id)
    {
        $geofencings = DB::table('geofencings')->where('id', $id)->first();
        return view('admin.geofencings.edit', compact('geofencings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'address' => 'required',
        ]);

        DB::table('geofencings')->where('id', $id)->update([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'address' => $request->address,
        ]);

        return redirect()->route('geofencings.index')
            ->with('success', 'Geofencing updated successfully');
    }

    public function destroy($id)
    {
        DB::table('geofencings')->where('id', $id)->update([
            'is_delete' => 1,
        ]);

        return redirect()->route('geofencings.index')
            ->with('success', 'Geofencing deleted successfully');
    }
}
