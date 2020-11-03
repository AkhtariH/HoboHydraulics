<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;
use App\Models\User;
use App\Models\Bridge;
use App\Models\Sensor;

class BridgeController extends Controller
{
    public function index(Request $request, $id) {

        if (Auth::check()){
            $bridges = Bridge::all();
            $bridgeData = Bridge::Where('id', $id)->get()->first();
            $sensorData = Sensor::Where('bridge_id', $id)->get()->first();
    
            if ( is_null($bridgeData) ) {
                return abort(404);
            }
            return view('bridge', compact('bridgeData', 'sensorData', 'bridges'));
        }

        return Redirect::to('login')->withErrors(['You have to be logged in!']);
    }
}
