@extends('layout.form')

@section('title', 'Register')

@section('content')
    <h3 class="mb-2 force-white">Register</h3>
    <small class="force-white">Add a new user</small>
    @if($errors->any())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <form action="{{ url('post-register') }}" method="POST" class="mt-2">
        {{ csrf_field() }}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" name="name" class="form-control mt-0" placeholder="Full name" aria-label="Full name" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="email" name="email" class="form-control mt-0" placeholder="e-Mail" aria-label="e-Mail" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" name="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
        </div>

        <div class="form-group">
            <button class="btn btn-light btn-block p-2 mb-1" type="submit" name="submit">Add user</button>
        </div>
    </form>
@endsection