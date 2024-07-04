<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{

    public function show($id)
    {
        // Mengambil data user dan employee terkait
        $user = DB::table('users')
            ->leftJoin('employees', 'users.employees_id', '=', 'employees.id')
            ->select('users.*', 'employees.*')
            ->where('users.id', $id)
            ->first();

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        return view('admin.users.show', compact('user'));
    }
}
