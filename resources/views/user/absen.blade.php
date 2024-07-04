@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style>
        #mapCheckin, #mapCheckout {
            height: 300px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Absensi</h1>
            </div>
            <div class="section-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <form class="form-inline mb-3 mb-md-0">
                            <div class="form-group mr-md-2">
                                <input type="text" class="form-control" placeholder="Month" id="month" name="month">
                            </div>
                            <div class="form-group mr-md-2">
                                <input type="text" class="form-control" placeholder="Year" id="year" name="year">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </form>
                        <div class="ml-md-auto mt-3 mt-md-0">
                            @if ($hasCheckedIn)
                                <button class="btn btn-icon btn-icon-left btn-primary" disabled>
                                    <i class="fas fa-right-to-bracket"></i> Sudah Check-In
                                </button>
                            @else
                                <a href="#" class="btn btn-icon btn-icon-left btn-primary" data-toggle="modal" data-target="#checkinModal">
                                    <i class="fas fa-right-to-bracket"></i> Absen Masuk
                                </a>
                            @endif
                            @if ($hasCheckedOut)
                                <button class="btn btn-icon btn-icon-left btn-danger" disabled>
                                    <i class="fas fa-sign-out-alt"></i> Sudah Check-Out
                                </button>
                            @else
                                <a href="#" class="btn btn-icon btn-icon-left btn-danger" data-toggle="modal" data-target="#checkoutModal">
                                    <i class="fas fa-sign-out-alt"></i> Absen Pulang
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="absensiTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                        <th>Aktivitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat oleh DataTables via Ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkinModalLabel">Check-In</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="mapCheckin"></div>
                        <p>Live Time: <span id="liveTimeCheckin"></span></p>
                        <button id="recordCheckin" class="btn btn-primary">Record Check-In</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Check-Out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="mapCheckout"></div>
                        <p>Live Time: <span id="liveTimeCheckout"></span></p>
                        <button id="recordCheckout" class="btn btn-primary">Record Check-Out</button>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($absensis as $absen)
        <div class="modal fade" id="detailModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $loop->iteration }}">Detail Aktivitas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Detail aktivitas untuk tanggal {{ $absen->date }}:</p>
                        <p>Waktu masuk: {{ $absen->check_in }}</p>
                        <p>Latlong_in: {{ $absen->latlong_in }}</p>
                        <p>Waktu pulang: {{ $absen->check_out ?? '-' }}</p>
                        <p>Latlong_out: {{ $absen->latlong_out }}</p>
                        <p>Status: {{ $absen->status }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- DataTables JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> --}}
    <script>
      $(document).ready(function() {
            $('#absensiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('absen.data') }}',
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'check_in', name: 'check_in' },
                    { data: 'check_out', name: 'check_out' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                order: [[0, 'desc']],
            });
        })
        var mapCheckin, mapCheckout;
        var checkinMarker, checkoutMarker;
        var employeesId = {{ auth()->user()->employees_id }}; // Mengambil employees_id dari backend

        function initializeMap(mapId, markerVar, callback) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    if (mapId === 'mapCheckin' && mapCheckin) {
                        mapCheckin.remove();
                    }

                    if (mapId === 'mapCheckout' && mapCheckout) {
                        mapCheckout.remove();
                    }

                    var map = L.map(mapId).setView([lat, lng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    markerVar = L.marker([lat, lng]).addTo(map);
                    if (callback) callback(map);
                }, function(error) {
                    alert('Error occurred. Error code: ' + error.code);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        $('#checkinModal').on('shown.bs.modal', function() {
            initializeMap('mapCheckin', checkinMarker, function(map) {
                mapCheckin = map;
            });
        });

        $('#checkoutModal').on('shown.bs.modal', function() {
            initializeMap('mapCheckout', checkoutMarker, function(map) {
                mapCheckout = map;
            });
        });

        function updateLiveTime() {
            var currentTime = new Date().toLocaleTimeString('en-GB', { hour12: false });
            $('#liveTimeCheckin').text(currentTime);
            $('#liveTimeCheckout').text(currentTime);
        }

        function formatTime(date) {
            return date.toLocaleTimeString('en-GB', { hour12: false });
        }

        function formatDate(date) {
            var day = String(date.getDate()).padStart(2, '0');
            var month = String(date.getMonth() + 1).padStart(2, '0');
            var year = date.getFullYear();

            return year + '-' + month + '-' + day;
        }

        function showSuccessNotification(title, text) {
            Swal.fire({
                icon: 'success',
                title: title,
                text: text,
                timer: 2000,
                showConfirmButton: false
            });
        }

        function showErrorNotification(title, text) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: text,
                timer: 2000,
                showConfirmButton: false
            });
        }

        $('#recordCheckin').click(function() {
            updateLiveTime();
            if (checkinMarker) {
                mapCheckin.removeLayer(checkinMarker);
            }
            var checkinLocation = mapCheckin.getCenter();
            checkinMarker = L.marker(checkinLocation).addTo(mapCheckin);
            console.log('Check-In Location:', checkinLocation);

            var checkinTime = formatTime(new Date());
            var currentDate = formatDate(new Date());
            var latlongIn = checkinLocation.lat + ',' + checkinLocation.lng;
            var status = checkinTime > '08:00:00' ? 'Terlambat' : 'On Time';

            $.ajax({
                url: "{{ route('absen.checkin') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    check_in: checkinTime,
                    latlong_in: latlongIn,
                    employees_id: employeesId,
                    date: currentDate,
                    status: status
                },
                success: function(response) {
                    var newRow = '<tr>' +
                        '<td>' + currentDate + '</td>' +
                        '<td>' + checkinTime + '</td>' +
                        '<td>-</td>' +
                        '<td><span class="badge badge-' + (status === 'Terlambat' ? 'danger' : 'success') + '">' + status + '</span></td>' +
                        '<td><button class="btn btn-success">Detail Aktivitas</button></td>' +
                        '</tr>';
                    
                    $('#absensiTable tbody').prepend(newRow);
                    console.log(response.success);

                    showSuccessNotification('Check-In Success', 'You have successfully checked in.');

                    $('#checkinModal').modal('hide');
                    $('.btn.btn-icon.btn-icon-left.btn-primary').prop('disabled', true).text('Sudah Check-In');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    showErrorNotification('Check-In Failed', 'You have already checked in today.');
                }
            });
        });

        $('#recordCheckout').click(function() {
            updateLiveTime();
            if (checkoutMarker) {
                mapCheckout.removeLayer(checkoutMarker);
            }
            var checkoutLocation = mapCheckout.getCenter();
            checkoutMarker = L.marker(checkoutLocation).addTo(mapCheckout);
            console.log('Check-Out Location:', checkoutLocation);

            var checkoutTime = formatTime(new Date());
            var currentDate = formatDate(new Date());
            var latlongOut = checkoutLocation.lat + ',' + checkoutLocation.lng;

            $.ajax({
                url: "{{ route('absen.checkout') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    check_out: checkoutTime,
                    latlong_out: latlongOut,
                    employees_id: employeesId,
                    date: currentDate
                },
                success: function(response) {
                    console.log(response.success);

                    $('#absensiTable tbody tr').each(function() {
                        var row = $(this);
                        var dateCell = row.find('td').eq(0).text();
                        if (dateCell === currentDate) {
                            row.find('td').eq(2).text(checkoutTime);
                        }
                    });

                    showSuccessNotification('Check-Out Success', 'You have successfully checked out.');

                    $('#checkoutModal').modal('hide');
                    $('.btn.btn-danger').prop('disabled', true).text('Sudah Check-Out');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    showErrorNotification('Check-Out Failed', 'You have already checked out today.');
                }
            });
        });

        // Update time every second
        setInterval(updateLiveTime, 1000);
    </script>
@endpush
