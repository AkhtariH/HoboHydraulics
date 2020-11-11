<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use App\Models\Bridge;
use App\Models\UserBridge;
use App\Models\Sensor;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.index');
    }

    public function assign(Request $request) {
        request()->validate([
            'id' => 'required',
            'bid' => 'required',
            'checked' => 'required',
        ]);
        
        $data = collect(['user_id' => $request->input('id')]);
        $data->put('bridge_id', $request->input('bid'));
        
        if ($request->input('checked') == 1) {
            UserBridge::create($data->toArray());
        } else {
            $user_bridge = UserBridge::where([
                ['user_id', '=', $request->input('id')], 
                ['bridge_id', '=', $request->input('bid')]
            ]);

            $user_bridge->delete();
        }


        return response()->json(array('msg', 'Success!'), 200);
    }

    public function threshold(Request $request) {
        request()->validate([
            'id' => 'required',
            'threshold_value' => 'required',
        ]);
        
        $data = collect(['threshold_value' => $request->input('threshold_value')]);

        $sensor = Sensor::findOrFail($request->input('id'));
        $sensor->update($data->toArray());

        return response()->json(array('msg', 'Success!'), 200);
    }
}
