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
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Profile Picture Column -->
                                    <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center">
                                        <div class="form-group text-center position-relative">
                                            <div>
                                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
                                                    class="rounded-circle" style="width: 250px;" alt="Avatar"
                                                    id="profileImage" />
                                                <input type="file" id="profileImageInput" class="d-none"
                                                    accept="image/*">
                                                <label for="profileImageInput" class="position-absolute"
                                                    style="bottom: 10px; right: 10px; cursor: pointer;">
                                                    <i class="fas fa-pencil-alt"
                                                        style="color: white; background-color: black; border-radius: 50%; padding: 5px;"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Profile Form Column -->
                                    <div class="col-lg-6 col-md-6">
                                        <form>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthplace">Birth Place</label>
                                                <input type="text" class="form-control" id="birthplace"
                                                    name="birthplace">
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">Birth Date</label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="single">Belum Menikah</option>
                                                    <option value="married">Menikah</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </form>
                                    </div>
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        document.getElementById('profileImage').addEventListener('click', function() {
            document.getElementById('profileImageInput').click();
        });

        document.getElementById('profileImageInput').addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
@endpush
