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
                    <div class="breadcrumb-item">Units</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Tambah Units</h2>
                <div class="card">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="units_id_parent">Parent Unit</label>
                                <input type="text" id="units_id_parent" name="units_id_parent" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-unit">
            <div class="modal-dialog modal-lg" role="main">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Units</h5>

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
                                    <label for="search">Search</label>
                                    <input type="search" class="form-control" id="search">
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
                            <div class="float-right">
                                {{ $units->withQueryString()->links() }}
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
        $('#unit').click(function() {
            $('#modal-unit').modal('show');
        });
    });
    $(document).ready(function() {
        $('#search').keyup(function() {
            var searchText = $(this).val().toLowerCase();

            // Loop through all table rows
            $('#unit-table tbody tr').each(function() {
                var unitName = $(this).find('td:eq(1)').text().toLowerCase();

                // If the search text is found in the employee name, show the row, otherwise hide it
                if (unitName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    $(document).ready(function() {
        $('.select-unit').on('click', function() {
            var unitId = $(this).data('unit-id');
            var unitName = $(this).data('unit-name');

            // Set the selected employee in the form select element
            $('#unit').append($('<option>', {
                value: unitId,
                text: unitName
            }));
            // Close the modal
            $('#modal-unit').modal('hide');
        });
    });
</script>
@endpush
