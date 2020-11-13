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
use App\Models\SensorData;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\AdminAssignRequest;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $sensor_count = Sensor::count();
        $sensor_data_count = DB::select('SELECT count(t.sensor_id) as ErrorCount FROM sensor_data t 
                            INNER JOIN ( SELECT sensor_id, max(created_at) AS MaxDate FROM sensor_data GROUP BY sensor_id ) tm 
                            ON t.sensor_id = tm.sensor_id AND t.created_at = tm.MaxDate 
                            WHERE t.error = 1'
        );
        $sensor_data_count = $sensor_data_count[0]->ErrorCount;
        $user_count = User::count();
        $bridge_count = Bridge::count();
        $assigned_bridges_count = UserBridge::all()->groupBy('bridge_id')->count(); 

        $data = [];
        $data['sensor_count'] = $sensor_count;
        $data['sensor_data_count'] = $sensor_data_count;
        $data['user_count'] = $user_count;
        $data['bridge_count'] = $bridge_count;
        $data['assigned_bridges_count'] = $assigned_bridges_count;
        $data['assigned_bridges_percentage'] = ($data['bridge_count'] > 0) ? ($data['assigned_bridges_count'] / $data['bridge_count']) * 100 : 100;

        return view('admin.index', compact('data'));
    }

    public function assign(AdminAssignRequest $request) {
        $request->validated();
        
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
}
