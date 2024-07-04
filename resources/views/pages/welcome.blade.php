@extends('layouts.app')

@section('title', 'Welcome')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Logged In</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="hero bg-primary text-white">
                            <div class="hero-inner">
                                <h2>Welcome Back, {{ auth()->user()->name }}</h2>
                                <p class="lead">App HCM semua menu, Kamu telah Login!</p>
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

    <!-- Page Specific JS File -->
@endpush
