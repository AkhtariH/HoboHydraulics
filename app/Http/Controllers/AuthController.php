<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Models\User;
use App\Models\Bridge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    
    public function index() {
        if (Auth::check()){
            return Redirect::to('dashboard');           
        }

        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function postLogin(AuthLoginRequest $request) {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $bridges = Bridge::all();

            return redirect()->intended('dashboard');
        }

        return Redirect::to('login')->withErrors(['Entered credetnials are wrong!']);
    }


    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => User::DEFAULT_ROLE
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
