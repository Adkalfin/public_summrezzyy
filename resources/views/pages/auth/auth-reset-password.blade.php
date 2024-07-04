@extends('layouts.app')

@section('title', 'Welcome')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Reset Password</h1>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Form Input</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Isikan Password lama dan Password baru</p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" type="password" class="form-control pwstrength"
                                data-indicator="pwindicator" name="current_password" tabindex="2" required>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                tabindex="2" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm Password</label>
                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation"
                                tabindex="2" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Reset Password
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
