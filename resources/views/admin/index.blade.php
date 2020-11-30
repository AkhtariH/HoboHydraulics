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
                            <h3 class="mt-0 mb-0"><strong>{{ $data['sensor_count'] }}</strong></h3>
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
                            <h3 class="mt-0 mb-0"><strong>{{ $data['sensor_data_count'] }}</strong></h3>
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
                            <h3 class="mt-0 mb-0"><strong>{{ $data['user_count'] }}</strong></h3>
                            <p><small class="text-muted bc-description">Total registered users</small></p>
                            <p class="see-more">
                                <small class="text-muted bc-description">
                                    <a href="{{ route('admin.user.index') }}">Manage users <i class="fas fa-arrow-circle-right align-middle see-more-arrow"></i></a>
                                </small>
                            </p>
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
                            <h3 class="mt-0 mb-0"><strong>{{ $data['bridge_count'] }}</strong></h3>
                            <p><small class="text-muted bc-description">Total registered bridges</small></p>
                            <p class="see-more">
                                <small class="text-muted bc-description">
                                    <a href="{{ route('admin.bridge.index') }}">Manage bridges <i class="fas fa-arrow-circle-right align-middle see-more-arrow"></i></a>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Skill bars-->
    <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
        <h6 class="mb-2">Bridges assigned {{ $data['assigned_bridges_count'] . '/' . $data['bridge_count']}}</h6>
        
        <p class="mb-2 mt-3">0% <span class="pull-right">100%</span></p>
        <div class="progress mb-4" style="height: 7px;">
            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $data['assigned_bridges_percentage'] }}" style="width: {{ $data['assigned_bridges_percentage'] }}%; "  aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <!--/Skill bars -->

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

@section('inclusions')
    @parent

    <script>

        var markerArr = [];
        var counter = 0;
        var bridges = {!! json_encode($bridges->toArray(), JSON_HEX_TAG) !!};

        function ajaxDone(msg) {
            var lat = Math.round((msg.results[0].locations[0].latLng.lat + Number.EPSILON) * 100) / 100;
            var lng = Math.round((msg.results[0].locations[0].latLng.lng + Number.EPSILON) * 100) / 100;
            var marker = { 
                latLng: [lat, lng],
                name: bridges[counter].name,
                url: '/admin/bridge/' + bridges[counter].id
            };
            markerArr.push(marker);
            counter++;
        }
        if($("#NLMap").length) {
           
            //console.log(bridges);

            for (var i = 0; i < bridges.length; i++) {
                $.ajax({
                    type: "POST",
                    url: 'http://open.mapquestapi.com/geocoding/v1/address?key=HSpGQTU57l0axHugD5o7BjhWZbGnM7Ru',
                    data: {
                        "location": bridges[i].adress,
                        "options": {
                            "thumbMaps": false
                        }
                    },
                    success: function(data) {
                        ajaxDone(data);
                    }
                });
            }


            setTimeout(function() {
                $('#NLMap').vectorMap({
                    map: 'nl_merc',
                    scaleColors: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial',
                    hoverOpacity: 0.7,
                    hoverColor: false,
                    regionStyle:{initial:{fill:"#004d40"}},
                    markerStyle: {
                        initial: {
                        fill: '#5c5c5c',
                        stroke: '#efefef'
                        }
                    },
                    backgroundColor: '#fff',
                    markers: markerArr,
                    onMarkerClick: function(event, index) {
                      window.location.href = markerArr[index].url;
                    }
                });
            }, 1000);
            

        }
    </script>
@endsection