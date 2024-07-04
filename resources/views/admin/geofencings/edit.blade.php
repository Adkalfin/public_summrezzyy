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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Geofencing</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Geofencing</h2>
                <div class="card">
                    <form action="{{ route('geofencings.update', $geofencings->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Geofencing Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $geofencings->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control"
                                    value="{{ $geofencings->latitude }}" required>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control"
                                    value="{{ $geofencings->longitude }}" required>
                            </div>
                            <div class="form-group">
                                <label for="radius">Radius</label>
                                <input type="text" id="radius" name="radius" class="form-control"
                                    value="{{ $geofencings->radius }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" class="form-control">{{ $geofencings->address }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <div class="button-container">
                                <button type="button" class="btn btn-warning" id="openMapButton">Open Map</button>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="modal" tabindex="-1" role="dialog" id="mapModal">
            <div class="modal-dialog modal-lg" role="main">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="map"></div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveLocationButton">Save Location</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.getElementById('openMapButton').onclick = function() {
            document.getElementById('mapModal').style.display = "block";
            showPosition({
                coords: {
                    latitude: parseFloat(document.getElementById('latitude').value),
                    longitude: parseFloat(document.getElementById('longitude').value)
                }
            });
        }

        document.querySelector('.close').onclick = function() {
            document.getElementById('mapModal').style.display = "none";
        }

        var map, marker;

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            marker = L.marker([lat, lng]).addTo(map);
            map.on('click', function(e) {
                var newLat = e.latlng.lat;
                var newLng = e.latlng.lng;
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
                document.getElementById('latitude').value = newLat;
                document.getElementById('longitude').value = newLng;
            });
        }

        document.getElementById('saveLocationButton').onclick = function() {
            document.getElementById('mapModal').style.display = "none";
        }
    </script>
@endpush
