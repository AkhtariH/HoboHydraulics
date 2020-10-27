<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
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
            return redirect()->intended('dashboard');
        }

        return Redirect::to('login')->withSuccess("Entered credetnials are wrong!");
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
            return view('dashboard');
        }

        return Redirect::to('login')->withSuccess('You have to be logged in!');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout () {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
