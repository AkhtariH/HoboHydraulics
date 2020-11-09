<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bridge;
use App\Models\Sensor;
use App\Models\User;
use App\Models\UserBridge;
use Validator,Redirect,Response;

class BridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //     public function index(Request $request, $id) {

        //         if (Auth::check()){
        //             $bridges = Bridge::all();
        //             $bridgeData = Bridge::Where('id', $id)->get()->first();
        //             $sensorData = Sensor::Where('bridge_id', $id)->get()->first();
            
        //             if ( is_null($bridgeData) ) {
        //                 return abort(404);
        //             }
        //             return view('bridge', compact('bridgeData', 'sensorData', 'bridges'));
        //         }

        //         return Redirect::to('login')->withErrors(['You have to be logged in!']);
        //     }


        $bridges = Bridge::latest()->paginate(9);
        return view('admin.bridge.index', compact('bridges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bridge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'bridgeHash' => $data['bridgeHash'],
        ]);


        return redirect()->route('admin.bridge.index')->with('success', 'Bridge has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bridge = Bridge::findOrFail($id);
        $sensors = Sensor::where('bridge_id', $id)->get();
        

        if (Auth()->user()->isAdmin()) {
            $users = User::where('type', 'employee')->get();
            // $userBridge = UserBridge::where('bridge_id', $id)->get();

            foreach ($users as $user) {
                $userBridge = UserBridge::where([
                    ['user_id', '=', $user->id], 
                    ['bridge_id', '=', $id]
                ])->get();

                if (!$userBridge->isEmpty()) {
                    $user->checked = true;
                } else {
                    $user->checked = false;
                }
            }

            
            return view('admin.bridge.show', compact('bridge', 'sensors', 'users'));
        }

        return view('admin.bridge.show', compact('bridge', 'sensors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bridge = Bridge::findOrFail($id);
        return view('admin.bridge.edit', compact('bridge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'adress' => 'required',
            'supervisor' => 'required',
            'bridgeHash' => 'required'
        ]);

        $data = $request->all();

        $bridge = Bridge::findOrFail($id);
        $bridge->update($data);

        return redirect()->route('admin.bridge.index')->with('success', 'Bridge has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bridge = Bridge::findOrFail($id);
        $bridge->delete();

        return redirect()->route('admin.bridge.index')->with('success', 'Bridge has been deleted!');
    }
}
