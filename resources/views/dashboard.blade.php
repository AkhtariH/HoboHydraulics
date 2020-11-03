@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<!--Dashboard widget-->
<div class="mt-1 mb-3 button-container">
    <div class="row pl-0">
        <div class="col-lg-6 col-md-4 col-sm-6 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                        <i class="fa fa-check-square"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong>5</strong></h3>
                        <p><small class="text-muted bc-description">Total Installed Devices</small></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-4 col-sm-5 col-12 mb-3">
            <div class="bg-white border shadow">
                <div class="media p-4">
                    <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="media-body pl-2">
                        <h3 class="mt-0 mb-0"><strong>2</strong></h3>
                        <p><small class="text-muted bc-description">Replacements Needed</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Dashboard widget-->

<div class="row mt-3">
    <div class="col-sm-12">
        <!--Jvector world map-->
        <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
            <h6 class="mb-3">Bridge Locations</h6><hr>
            <div id="NLMap" style="width: 100%; height: 500px"></div>
            
        </div>
        <!--/Jvector world map-->
    </div>
</div>
@endsection