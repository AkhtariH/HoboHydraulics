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

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!--Content types-->
    <h4 class="inline">Profile</h4>
    <hr/>
    <div class="mt-1 mb-5 button-container">
        <div class="card shadow-sm">
            <div class="card-body">
                <!--Image Avatar-->
                <div class="avatar text-center">
                    <img src="{{ asset('/img/uploads') . '/' . $user->profile_image }}" alt="" class="rounded-circle profile-image" />
                    <p class="p-typo"><strong>{{ $user->name }}</strong></p>
                    <p class="p-typo"><strong>E-Mail:</strong> {{ $user->email }}</p>
                    <p class="p-typo"><strong>Type:</strong> {{ ucfirst($user->type) }}</p>
                    <p class="p-typo"><strong>Creation date:</strong> {{ date('d-m-Y', strtotime($user->created_at)) }}</p>
                    <p class="see-more margin">
                        <small class="text-muted bc-description">
                            <a href="{{ route('profile.edit') }}">Edit profile <i class="fas fa-arrow-circle-right align-middle see-more-arrow"></i></a>
                        </small>
                    </p>
                </div>
                <!--Image Avatar-->
            </div>
        </div>
    </div>

<!--/Content types-->
@endsection