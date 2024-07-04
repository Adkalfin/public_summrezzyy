<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->leftJoin('employees', 'users.employees_id', '=', 'employees.id')
            ->select('users.id', 'users.name as name', 'employees.name as empname', 'users.username', 'users.email')
            ->where('users.is_active', 1)
            ->where('users.is_delete', 0)
            ->where('users.name', 'like', '%' . request('name') . '%')
            ->orderBy('users.id', 'desc')
            ->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $employees = DB::table('employees')
            ->orderBy('id', 'asc')
            ->paginate(5);
        $geofencings = DB::table('geofencings')
            ->orderBy('id', 'asc')
            ->paginate(5);
        $schedules = DB::table('schedules')
            ->orderBy('id', 'asc')
            ->paginate(5);
        return view('admin.users.create', compact('employees', 'geofencings', 'schedules'));
    }

    //store
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'username' => 'required',

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'employees_id' => (int) $request->employees_id,
            'geofencings_id' => (int) $request->geofencings_id,
            'schedule_id' => (int) $request->schedule_id,
            'password' => Hash::make($request->password),
            'is_delete' => 0,
            'is_active' => 1,
        ];

        // dd($data);
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }


    public function edit($id)
    {
        $user = DB::table('users')
            ->leftJoin('employees', 'users.employees_id', '=', 'employees.id')
            ->leftJoin('geofencings', 'users.geofencings_id', '=', 'geofencings.id')
            ->leftJoin('schedules', 'users.schedules_id', '=', 'schedules.id')
            ->select('users.id', 'geofencings_id', 'schedules_id', 'employees_id', 'users.name as name', 'employees.name as employee_name', 'users.username', 'users.email', 'users.role', 'geofencings.name as geofencings_name', 'schedules.name as schedules_name')
            ->where('users.id', $id)
            ->first();

        $employees = DB::table('employees')
            ->orderBy('id', 'asc')
            ->paginate(5);
        $geofencings = DB::table('geofencings')
            ->orderBy('id', 'asc')
            ->paginate(5);
        $schedules = DB::table('schedules')
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('admin.users.edit', compact('user', 'employees', 'geofencings', 'schedules'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'username' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'employees_id' => (int) $request->employees_id,
            'geofencings_id' => (int) $request->geofencings_id,
            'schedule_id' => (int) $request->schedule_id,
        ];

        $user->update($data);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->is_delete = 1;
        $user->save();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
