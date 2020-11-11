@extends('layout.app')

@section('title', 'Admin Panel')

@section('content')
    @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <h3>Admininstrator Dashboard</h3>
    
    <h4 class="widget-header">Statistics</h4>
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

        <div class="row pl-0">
            <div class="col-lg-6 col-md-4 col-sm-6 col-12 mb-3">
                <div class="bg-white border shadow">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>5</strong></h3>
                            <p><small class="text-muted bc-description">Total registered users</small></p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6 col-md-4 col-sm-5 col-12 mb-3">
                <div class="bg-white border shadow">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                            <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-align-center" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 1a.5.5 0 0 1 .5.5V6h-1V1.5A.5.5 0 0 1 8 1zm0 14a.5.5 0 0 1-.5-.5V10h1v4.5a.5.5 0 0 1-.5.5zM2 7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7z"/>
                              </svg>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>2</strong></h3>
                            <p><small class="text-muted bc-description">Total registered bridges</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Skill bars-->
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <h6 class="mb-2"></h6>
        
        <p class="mb-2 mt-3">0% <span class="pull-right">70%</span></p>
        <div class="progress mb-4" style="height: 7px;">
            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="70" style="width: 70%"  aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <!--/Skill bars -->


@endsection