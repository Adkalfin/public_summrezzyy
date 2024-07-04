@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>
            <div class="card">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Form Edit</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password">
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="employee" class="form-label">Employee</label>
                            <input type="text" class="form-control" name="employee_name" id="employee"
                                value="{{ $user->employee_name }}">
                            <input type="hidden" name="employee_id" id="employee-id" value="{{ $user->employees_id }}">
                        </div>
                        <div class="form-group">
                            <label for="geofencing" class="form-label">Geofencing</label>
                            <input type="text" class="form-control" name="geofencings_name" id="geofencing"
                                value="{{ $user->geofencings_name }}">
                            <input type="hidden" name="geofencings_id" id="geofencings-id"
                                value="{{ $user->geofencings_id }}">
                        </div>
                        <div class="form-group">
                            <label for="schedule" class="form-label">Schedule</label>
                            <input type="text" class="form-control" name="schedules_name" id="schedule"
                                value="{{ $user->schedules_name }}">
                            <input type="hidden" name="schedules_id" id="schedules-id" value="{{ $user->schedules_id }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Roles</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="admin" class="selectgroup-input"
                                        @if ($user->role == 'admin') checked @endif>
                                    <span class="selectgroup-button">Admin</span>
                                </label>

                                <label class="selectgroup-item">
                                    <input type="radio" name="role" value="user" class="selectgroup-input"
                                        @if ($user->role == 'user') checked @endif>
                                    <span class="selectgroup-button">Staff</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-employee">
        <div class="modal-dialog modal-lg" role="main">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h4>Employees</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-employee">Search</label>
                                <input type="search" class="form-control" id="search-employee">
                            </div>
                            <table class="table table-hover" id="employee-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary select-employee"
                                                    data-employee-id="{{ $employee->id }}"
                                                    data-employee-name="{{ $employee->name }}">Select</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-geofencing">
        <div class="modal-dialog modal-lg" role="main">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Geofencing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h4>Geofencings</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-geofencing">Search</label>
                                <input type="search" class="form-control" id="search-geofencing">
                            </div>
                            <table class="table table-hover" id="geofencing-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($geofencings as $geofencing)
                                        <tr>
                                            <td>{{ $geofencing->id }}</td>
                                            <td>{{ $geofencing->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary select-geofencing"
                                                    data-geofencing-id="{{ $geofencing->id }}"
                                                    data-geofencing-name="{{ $geofencing->name }}">Select</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            {{ $geofencings->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Schedule -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-schedule">
        <div class="modal-dialog modal-lg" role="main">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h4>Schedules</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="search-schedule">Search</label>
                                <input type="search" class="form-control" id="search-schedule">
                            </div>
                            <table class="table table-hover" id="schedule-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->id }}</td>
                                            <td>{{ $schedule->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary select-schedule"
                                                    data-schedule-id="{{ $schedule->id }}"
                                                    data-schedule-name="{{ $schedule->name }}">Select</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            {{ $schedules->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tampilkan modal saat input employee, geofencing, atau schedule diklik
            $('#employee').click(function() {
                $('#modal-employee').modal('show');
            });

            $('#geofencing').click(function() {
                $('#modal-geofencing').modal('show');
            });

            $('#schedule').click(function() {
                $('#modal-schedule').modal('show');
            });

            // Filter pencarian pada tabel employee
            $('#search-employee').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#employee-table tbody tr').each(function() {
                    var employeeName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(employeeName.includes(searchText));
                });
            });

            // Filter pencarian pada tabel geofencing
            $('#search-geofencing').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#geofencing-table tbody tr').each(function() {
                    var geofencingName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(geofencingName.includes(searchText));
                });
            });

            // Filter pencarian pada tabel schedule
            $('#search-schedule').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#schedule-table tbody tr').each(function() {
                    var scheduleName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(scheduleName.includes(searchText));
                });
            });

            // Pilih employee dari tabel
            $(document).on('click', '.select-employee', function() {
                var employeeId = parseInt($(this).data('employee-id'), 10); // Konversi ke integer
                var employeeName = $(this).data('employee-name');

                // Isi input dengan nama employee yang dipilih
                $('#employee').val(employeeName);

                // Pastikan input hidden untuk employee_id ada dan isi dengan ID yang dipilih
                $('#employee-id').val(employeeId);

                // Tutup modal
                $('#modal-employee').modal('hide');
            });

            // Pilih geofencing dari tabel
            $(document).on('click', '.select-geofencing', function() {
                var geofencingId = parseInt($(this).data('geofencing-id'), 10); // Konversi ke integer
                var geofencingName = $(this).data('geofencing-name');

                // Isi input dengan nama geofencing yang dipilih
                $('#geofencing').val(geofencingName);

                // Pastikan input hidden untuk geofencing_id ada dan isi dengan ID yang dipilih
                $('#geofencings-id').val(geofencingId);

                // Tutup modal
                $('#modal-geofencing').modal('hide');
            });

            // Pilih schedule dari tabel
            $(document).on('click', '.select-schedule', function() {
                var scheduleId = parseInt($(this).data('schedule-id'), 10); // Konversi ke integer
                var scheduleName = $(this).data('schedule-name');

                // Isi input dengan nama schedule yang dipilih
                $('#schedule').val(scheduleName);

                // Pastikan input hidden untuk schedule_id ada dan isi dengan ID yang dipilih
                $('#schedules-id').val(scheduleId);

                // Tutup modal
                $('#modal-schedule').modal('hide');
            });
        });
    </script>
@endpush
