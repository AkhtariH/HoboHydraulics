@extends('layout.app')

@section('title', 'Bridge')

@section('content')
    <!-- Skill bars-->
    <!-- <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                <h6 class="mb-2">Estimated lifespan</h6>
                
                <p class="mb-2 mt-3">lifespan <span class="pull-right">70%</span></p>
                <div class="progress mb-4" style="height: 7px;">
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="70" style="width: 70%"  aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div> -->
    <!--/Skill bars -->

    <!--Content types-->
    <div class="mt-1 mb-5 button-container">
        <div class="card shadow-sm">
            <div class="card-body">

                <h6>Bridge information</h6>
                <p class="p-typo">Name: {{ $bridgeData->name }}</p>
                <p class="p-typo">Address: {{ $bridgeData->adress }}</p>
            </div>
        </div>
    </div>

    <div class="mt-1 mb-5 button-container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Sensor Information</h6>
                <p class="p-typo">Name: {{ $sensorData->name }}</p>
                <p class="p-typo">Type: {{ $sensorData->type }}</p>
                <p class="p-typo">Data: // TODO</p>
            </div>
        </div>
    </div>

    <!--Google world-->
    <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
        <h6 class="mb-2">Bridge location</h6>
        <div id="google_ptm_map" style="width: 100%; height: 300px"></div>
    </div>

<!--/Content types-->
@endsection