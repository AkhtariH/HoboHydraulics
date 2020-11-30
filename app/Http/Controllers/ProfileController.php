<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
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
        $user = Auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->validated();

        $user = Auth::user();
        $data = collect($request->except(['profile_image']));

        if ($request->has('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();  
            $request->profile_image->move(public_path('img/uploads/'), $imageName);
            $data->put('profile_image', $imageName);

            if(File::exists(public_path('img/uploads/' . $user->profile_image))){
                File::delete(public_path('img/uploads/' . $user->profile_image));
            }
        }

        $user->update($data->toArray());

        return redirect()->route('profile.index')->with('success', 'Your profile has been updated!');
    }
}
