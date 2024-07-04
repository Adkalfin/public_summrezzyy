@extends('layouts.error')

@section('title', '403')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="page-error">
        <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
                gak oleh lewat sini, Balik dulu
            </div>
            <div class="page-search">
                <form>
                    <div class="form-group floating-addon floating-addon-not-append">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                      <button class="btn btn-primary" onclick="goBack()">Back to Home</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endpush
