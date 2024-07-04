@extends('layouts.app')

@section('title', 'Advanced Forms')

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
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Positions</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Position</h2>
                <div class="card">
                    <form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Positions Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $position->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $position->name }}">
                            </div>

                            <div class="form-group">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_name" id="jabatan" value="{{ $position->jabatan->name }}">
                                <input type="hidden" name="jabatans_id" id="jabatans-id" value="{{ $position->jabatans_id }}">
                            </div>
                            <div class="form-group">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" class="form-control" name="unit_name" id="unit" value="{{ $position->unit->name }}">
                                <input type="hidden" name="units_id" id="units-id" value="{{ $position->units_id }}">
                            </div>
                            <div class="form-group">
                                <label for="position" class="form-label">Parent Position</label>
                                <input type="text" class="form-control" name="position_name" id="position" value="{{ $position->parentPosition->name }}">
                                <input type="hidden" name="positions_id_parent" id="positions-id-parent" value="{{ $position->positions_id_parent }}">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-jabatan">
            <div class="modal-dialog modal-lg" role="main">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h4>Jabatans</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="search-jabatan">Search</label>
                                    <input type="search" class="form-control" id="search-jabatan">
                                </div>
                                <table class="table table-hover" id="jabatan-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatans as $jabatan)
                                            <tr>
                                                <td>{{ $jabatan->id }}</td>
                                                <td>{{ $jabatan->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary select-jabatan"
                                                        data-jabatan-id="{{ $jabatan->id }}"
                                                        data-jabatan-name="{{ $jabatan->name }}">Select</button>
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

        <!-- Modal untuk Unit -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-unit">
            <div class="modal-dialog modal-lg" role="main">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h4>Units</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="search-unit">Search</label>
                                    <input type="search" class="form-control" id="search-unit">
                                </div>
                                <table class="table table-hover" id="unit-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $unit)
                                            <tr>
                                                <td>{{ $unit->id }}</td>
                                                <td>{{ $unit->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary select-unit"
                                                        data-unit-id="{{ $unit->id }}"
                                                        data-unit-name="{{ $unit->name }}">Select</button>
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

        <!-- Modal untuk Position -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-position">
            <div class="modal-dialog modal-lg" role="main">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h4>Positions</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="search-position">Search</label>
                                    <input type="search" class="form-control" id="search-position">
                                </div>
                                <table class="table table-hover" id="position-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($positions as $position)
                                            <tr>
                                                <td>{{ $position->id }}</td>
                                                <td>{{ $position->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary select-position"
                                                        data-position-id="{{ $position->id }}"
                                                        data-position-name="{{ $position->name }}">Select</button>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tampilkan modal saat input diklik
            $('#jabatan').click(function() {
                $('#modal-jabatan').modal('show');
            });

            $('#unit').click(function() {
                $('#modal-unit').modal('show');
            });

            $('#position').click(function() {
                $('#modal-position').modal('show');
            });

            // Filter pencarian pada tabel jabatan
            $('#search-jabatan').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#jabatan-table tbody tr').each(function() {
                    var jabatanName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(jabatanName.includes(searchText));
                });
            });

            // Filter pencarian pada tabel unit
            $('#search-unit').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#unit-table tbody tr').each(function() {
                    var unitName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(unitName.includes(searchText));
                });
            });

            // Filter pencarian pada tabel position
            $('#search-position').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#position-table tbody tr').each(function() {
                    var positionName = $(this).find('td:eq(1)').text().toLowerCase();
                    $(this).toggle(positionName.includes(searchText));
                });
            });

            // Pilih jabatan dari tabel
            $(document).on('click', '.select-jabatan', function() {
                var jabatanId = parseInt($(this).data('jabatan-id'), 10); // Konversi ke integer
                var jabatanName = $(this).data('jabatan-name');

                // Isi input dengan nama jabatan yang dipilih
                $('#jabatan').val(jabatanName);

                // Pastikan input hidden untuk jabatan_id ada dan isi dengan ID yang dipilih
                $('#jabatans-id').val(jabatanId);

                // Tutup modal
                $('#modal-jabatan').modal('hide');
            });

            // Pilih unit dari tabel
            $(document).on('click', '.select-unit', function() {
                var unitId = parseInt($(this).data('unit-id'), 10); // Konversi ke integer
                var unitName = $(this).data('unit-name');

                // Isi input dengan nama unit yang dipilih
                $('#unit').val(unitName);

                // Pastikan input hidden untuk unit_id ada dan isi dengan ID yang dipilih
                $('#units-id').val(unitId);

                // Tutup modal
                $('#modal-unit').modal('hide');
            });

            // Pilih position dari tabel
            $(document).on('click', '.select-position', function() {
                var positionId = parseInt($(this).data('position-id'), 10); // Konversi ke integer
                var positionName = $(this).data('position-name');

                // Isi input dengan nama position yang dipilih
                $('#position').val(positionName);

                // Pastikan input hidden untuk position_id ada dan isi dengan ID yang dipilih
                $('#positions-id-parent').val(positionId);

                // Tutup modal
                $('#modal-position').modal('hide');
            });
        });
    </script>
@endpush
