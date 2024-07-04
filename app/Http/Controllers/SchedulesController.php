<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    public function index()
    {
        $schedules = DB::table('schedules')->where('is_active', 1)->where('is_delete', 0)
            ->orderBy('id', 'asc')->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        DB::table('schedules')->insert([
            'name' => $request->name,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
            'is_active' => 1,
            'is_delete' => 0,
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit($id)
    {
        $schedules = DB::table('schedules')->where('id', $id)->first();
        return view('admin.schedules.edit', compact('schedules'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        DB::table('schedules')->where('id', $id)->update([
            'name' => $request->name,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully');
    }

    public function destroy($id)
    {
        DB::table('schedules')->where('id', $id)->update([
            'is_delete  ' => 1,
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully');
    }
}
