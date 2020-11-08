<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use App\Models\Bridge;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.index');
    }

    public function register() {
        return view('admin.register');
    }

    public function postRegister(Request $request) {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type' => 'required'
        ]);

        $data = $request->all();

        $check = $this->create($data);

        // TODO: send email to user with credentials

        return Redirect::to('admin')->with('success', 'User has been created!');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type']
        ]);
    }

    public function addBridge() {
        return view('admin.bridge');
    }

    public function postAddBridge(Request $request) {
        request()->validate([
            'name' => 'required',
            'adress' => 'required',
            'supervisor' => 'required',
            'bridgeHash' => 'required|unique:bridges'
        ]);

        $data = $request->all();

        $check = Bridge::create([
            'name' => $data['name'],
            'adress' => $data['adress'],
            'supervisor' => $data['supervisor'],
            'bridgeHash' => $data['bridgeHash']
        ]);

        // TODO: send email to user with credentials

        return Redirect::to('admin')->with('success', 'Bridge has been created!');
    }
}
