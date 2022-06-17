@extends('backend.layouts.app')

@section('header')
    <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
    <style>#fm {height: 100%}</style>
@endsection

@section('content')
    @include('backend.helpers.flash-massages')
    <div class="container-fluid mt-2 mb-5 bg-white p-3 rounded">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <h1 class="h4 m-0"><i class="bi bi-image me-2"></i> Media</h1>
            </div>

            <div class="col-md-12">
                <hr>
                <div class="row">
                    <div class="col-md-12" id="fm-main-block">
                        <div id="fm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');
            fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                window.opener.fmSetLink(fileUrl);
                window.close();
            });
        });
    </script>
@endsection
