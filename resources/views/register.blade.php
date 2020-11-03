@extends('layout.app')

@section('title', 'Register')

@section('content')
    <div class="card-body">
        <form action="{{url('post-register')}}" method="POST" id="regForm">
        {{ csrf_field() }}
            <div class="form-group">
                <label class="small mb-1" for="inputFirstName">Full Name</label>
                <input class="form-control py-4" id="inputFirstName" type="text" name="name" placeholder="Enter Full Name" />
                @if ($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
                @endif  
            </div>
            <div class="form-group">
                <label class="small mb-1" for="inputEmailAddress">Email</label>
                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="email" placeholder="Enter email address" />
                @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="small mb-1" for="inputPassword">Password</label>
                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group mt-4 mb-0">
                <button class="btn btn-primary btn-block" type="submit">Create Account</button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center">
        <div class="small"><a href="{{url('login')}}">Have an account? Go to login</a></div>
    </div>
@endsection