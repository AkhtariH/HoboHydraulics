<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bridge;
use App\Models\UserBridge;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Events\NewUserRegistered;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('type', 'customer')->latest()->get();
        $employees = User::where('type', 'employee')->latest()->get();
        $admins = User::where('type', 'admin')->latest()->get();

        return view('admin.user.index', compact('customers', 'employees', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $check = User::create($data);

        event(new NewUserRegistered($check));

        return redirect()->route('admin.user.index')->with('success', 'User has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $bridges = User::join('user_bridge', 'users.id', '=', 'user_bridge.user_id')
                        ->join('bridges', 'user_bridge.bridge_id', '=', 'bridges.id')
                        ->where('users.id', $id)
                        ->select('users.*', 'bridges.name', 'bridges.adress', 'bridges.supervisor')
                        ->get();

        return view('admin.user.show', compact('user', 'bridges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $request->validated();

        $data = $request->except('password');
        if ($request->has('password') && $request->password != '') {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User has been deleted!');
    }
}
