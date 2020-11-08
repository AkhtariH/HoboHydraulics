<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Models\User;
use App\Models\Bridge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

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

    public function postLogin(Request $request) {
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $bridges = Bridge::all();

            return redirect()->intended('dashboard');
        }

        return Redirect::to('login')->withErrors(['Entered credetnials are wrong!']);
    }

    public function postRegister(Request $request) {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return Redirect::to('dashboard')->withSuccess('You have been logged in!');
    }

    public function dashboard() {
        if (Auth::check()) {
            $bridges = Bridge::all();
            
            return view('dashboard', compact('bridges'));
        }

        return Redirect::to('login')->withErrors(['You have to be logged in!']);
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
