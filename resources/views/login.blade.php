@extends('layout.form')

@section('title', 'LogIn')

@section('content')
    <h3 class="mb-2 force-white">Login</h3>
    <small class="force-white">Sign in with your credentials</small>
    @if($errors->any())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <form action="{{ url('post-login') }}" method="POST" class="mt-2">
        {{ csrf_field() }}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" name="email" class="form-control mt-0" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" name="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
        </div>

        <div class="form-group">
            <button class="btn btn-light btn-block p-2 mb-1" type="submit" name="submit">Login</button>
            <a href="#">
                <small class="force-white"><strong>Forgot password?</strong></small>
            </a>
        </div>

        <div class="form-group">
            <a href="{{ url('register') }}">
                <small class="force-white"><strong>Need an account? Sign up!</strong></small>
            </a>
        </div>
        
    </form>
@endsection