@extends('layouts.app')

@section('title', 'Edit Profil Perusahaan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Profil Perusahaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Edit Profil Perusahaan</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Edit Profil Perusahaan</h2>
                <p class="section-lead">
                    Perbarui informasi tentang perusahaan Anda di halaman ini.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="POST" action="{{ route('companies.update', $companies->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $companies->name }}">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Alamat Perusahaan</label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $companies->address }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email Perusahaan</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $companies->email }}">
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Code Perusahaan</label>
                                            <input type="code" name="code" class="form-control"
                                                value="{{ $companies->code }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
