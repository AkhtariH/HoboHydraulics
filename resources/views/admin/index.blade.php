@extends('layout.app')

@section('title', 'Admin Panel')

@section('content')
    @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <h3>Bridges</h3>

    <div class="row pl-0">
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-check-square"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong>Bridge 1</strong></h3>
                        <p><small class="text-muted bc-description">...</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3>Users</h3>

    <div class="row pl-0">
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-check-square"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong>User 1</strong></h3>
                        <p><small class="text-muted bc-description">...</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection