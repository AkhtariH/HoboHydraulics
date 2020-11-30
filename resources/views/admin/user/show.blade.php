@extends('layout.app')

@section('title', $user->name)

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
    <h4 class="inline">User information</h4>
    <a href="{{ route('admin.user.edit', $user->id) }}"><span class="edit-bridge"><i class="fas fa-pencil-alt"></i></span></a>
    <hr/>
    <div class="mt-1 mb-5 button-container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="avatar text-center">
                    <img src="{{ asset('/img/uploads') . '/' . $user->profile_image }}" alt="" class="rounded-circle profile-image" />
                    <div class="form-group" id="imageUpload">
                        <label for="image">{{ $user->name }}</label>
                        <p class="p-typo"><strong>E-Mail:</strong> {{ $user->email }}</p>
                        <p class="p-typo"><strong>Type:</strong> {{ ucfirst($user->type) }}</p>
                        <p class="p-typo"><strong>Creation date:</strong> {{ date('d-m-Y', strtotime($user->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4>Bridges</h4>
    <hr/>
    <div class="row pl-0" id="sensor-row">
        @if (!$bridges->isEmpty())
            @foreach ($bridges as $bridge)
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                <div class="bg-white border shadow">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon">
                            <i class="far fa-check-circle sensor-good"></i>
                        </div>
                        <div class="media-body pl-2">
                            <h5 class="mt-0 mb-0">
                                <strong style="font-size: 16px;font-weight: 500 !important;">
                                    {{ $bridge->name }}
                                </strong>
                            </h5>
                            <p><small class="text-muted bc-description"><strong>Adress:</strong> {{ $bridge->adress }}</small></p>
                            <p>
                                <small class="text-muted bc-description">
                                    <strong>Supervisor:</strong> {{ $bridge->supervisor }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 user-card">
            <p>There are no assigned bridges!</p>
        </div>
        @endif
    </div>

<!--/Content types-->
@endsection