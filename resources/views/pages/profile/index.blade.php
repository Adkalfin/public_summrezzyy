@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Profile</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile View</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Profile Picture Column -->
                                    <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center">
                                        <div class="form-group text-center position-relative">
                                            <div>
                                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
                                                    class="rounded-circle" style="width: 250px;" alt="Avatar">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Profile Form Column -->
                                    <div class="col-lg-6 col-md-6">
                                        <form>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthplace">Birth Place</label>
                                                <input type="text" class="form-control" id="birthplace" name="birthplace"
                                                    value="{{ $user->birthplace }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">Birth Date</label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate"
                                                    value="{{ $user->birthdate }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ $user->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="single"
                                                        {{ $user->status == 'single' ? 'selected' : '' }}>Belum Menikah
                                                    </option>
                                                    <option value="married"
                                                        {{ $user->status == 'married' ? 'selected' : '' }}>Menikah</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3">{{ $user->address }}</textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    </script>
@endpush
