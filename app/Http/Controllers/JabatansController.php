<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatansController extends Controller
{
    public function index()
    {
        $jabatans = DB::table('jabatans')->where('is_active', 1)->where('is_delete', 0)
        ->orderBy('id', 'asc')->paginate(10);
        return view('admin.jabatans.index', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::table('jabatans')->insert([
            'name' => $request->name,
            'is_active' => 1,
            'is_delete' => 0,
        ]);

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan created successfully.');
    }

    public function edit($id)
    {
        $jabatans = DB::table('jabatans')->where('id', $id)->first();
        return view('admin.jabatans.edit', compact('jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::table('jabatans')->where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan updated successfully');
    }

    public function destroy($id)
    {
        DB::table('jabatans')->where('id', $id)->update([
            'is_deleted' => 1,
        ]);

        return redirect()->route('jabatans.index')
            ->with('success', 'Jabatan deleted successfully');
    }
}
