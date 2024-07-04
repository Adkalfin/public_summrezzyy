<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AbsenController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $employeeId = auth()->user()->employees_id;

        // Ambil data absensi hari ini untuk pengguna
        $absensiToday = Absensi::where('date', $today)
            ->where('employees_id', $employeeId)
            ->first();

        // Tentukan status check-in dan check-out
        $hasCheckedIn = $absensiToday && $absensiToday->check_in ? true : false;
        $hasCheckedOut = $absensiToday && $absensiToday->check_out ? true : false;

        $absensis = Absensi::where('employees_id', $employeeId)->get();
        return view('user.absen', compact('employeeId', 'absensis', 'hasCheckedIn', 'hasCheckedOut'));
    }

    public function checkin(Request $request)
    {
        Log::info('Check-in Request:', $request->all());

        $validated = $request->validate([
            'date' => 'required|date',
            'check_in' => 'required|date_format:H:i:s',
            'latlong_in' => 'required|string',
            'employees_id' => 'required|integer',
            'status' => 'required|string'
        ]);

        // Periksa apakah user sudah check-in pada hari yang sama
        $existingCheckin = Absensi::where('date', $validated['date'])
            ->where('employees_id', $validated['employees_id'])
            ->first();

        if ($existingCheckin) {
            return redirect()->back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        $data = [
            'date' => $validated['date'],
            'check_in' => $validated['check_in'],
            'latlong_in' => $validated['latlong_in'],
            'employees_id' => $validated['employees_id'],
            'check_out' => null,
            'latlong_out' => null,
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Absensi::create($data);
        return redirect()->back()->with('success', 'Check-in berhasil');
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'check_out' => 'required|date_format:H:i:s',
            'latlong_out' => 'required|string',
            'employees_id' => 'required|integer',
        ]);

        // Periksa apakah user sudah check-out pada hari yang sama
        $existingCheckout = Absensi::where('date', $validated['date'])
            ->where('employees_id', $validated['employees_id']) // Tambahkan kondisi untuk employees_id
            ->whereNotNull('check_out')
            ->first();

        if ($existingCheckout) {
            return redirect()->back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $absensi = Absensi::where('date', $validated['date'])
            ->where('employees_id', $validated['employees_id']) // Tambahkan kondisi untuk employees_id
            ->first();

        if (!$absensi) {
            return response()->json(['error' => 'Data absensi tidak ditemukan.'], 404);
        }

        $absensi->update([
            'check_out' => $validated['check_out'],
            'latlong_out' => $validated['latlong_out'],
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Check-out berhasil');
    }

    public function getData(Request $request)
    {
        $employeeId = auth()->user()->employees_id;
        $absensis = Absensi::where('employees_id', $employeeId)->get();

        // // Debugging response
        return response()->json([
            'data' => $absensis
        ]);

        Log::info('Absensi Data:', $absensis->toArray());

        return DataTables::of($absensis)
            ->addColumn('action', function ($absen) {
                return '<button class="btn btn-success btn-detail" data-toggle="modal"
                        data-target="#detailModal' . $absen->id . '"
                        data-absen-id="' . $absen->id . '">Detail Aktivitas</button>';
            })
            ->editColumn('status', function ($absen) {
                if ($absen->status == 'Terlambat') {
                    return '<span class="badge badge-danger">' . $absen->status . '</span>';
                } else {
                    return '<span class="badge badge-success">' . $absen->status . '</span>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);


        // Debugging JSON response
        Log::info('DataTables response:', $absensis->toArray());
        return $absensis;
    }
}