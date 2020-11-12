@extends('layout.app')

@section('title', 'Manage bridges')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="custom-header">
        <h3>Bridges</h3>
    </div>
    <hr/>
    <div class="row pl-0">
        @if (!$bridges->isEmpty())
            @foreach ($bridges as $bridge)
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                @if ($bridge->error == false)
                                    <i class="far fa-check-circle sensor-good"></i>
                                @else
                                    <i class="fas fa-exclamation-triangle sensor-error"></i>
                                @endif
                            </div>
                            <div class="media-body pl-2">
                                <h5 class="mt-0 mb-0"><strong><a href="{{ route('dashboard.show', $bridge->id) }}" class="bootstrap-link">{{ $bridge->name }}</a></strong></h5>
                                <p><small class="text-muted bc-description">{{ ucfirst($bridge->adress) }}</small></p>
                                <p><small class="text-muted bc-description">Supervisor: {{ $bridge->supervisor }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 user-card">
                <p>There are no bridges assigned to your account!</p>
            </div>
        @endif
    </div>
@endsection