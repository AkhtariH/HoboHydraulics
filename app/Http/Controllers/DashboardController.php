<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bridge;
use App\Models\Sensor;
use App\Models\SensorData;
use App\Models\User;
use App\Models\UserBridge;

use App\Events\SensorThresholdExceeded;

class DashboardController extends Controller
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
        $bridges = Bridge::join('user_bridge', 'bridges.id', '=', 'user_bridge.bridge_id')
                        ->select('bridges.*')
                        ->where('user_bridge.user_id', Auth()->user()->id)
                        ->latest()->paginate(9);

        // $bridges = Bridge::where('')->latest()->paginate(9);
        foreach($bridges as $bridge) {
            $sensors = $this->getSensorsOfBridge($bridge->id);
            
            foreach($sensors as $sensor) {
                if (count($sensor->data_collection) > 0) {
                    if ($sensor->data_collection[0]->error == true) {
                        $bridge->error = true;
                        break;
                    }
                }
                $bridge->error = false;
            }
        }
        

        return view('dashboard.index', compact('bridges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bridge = Bridge::findOrFail($id); // Only show bridges that are assigned to the user
        $sensors = $this->getSensorsOfBridge($id);
        // foreach ($sensors as $sensor) {
        //     if ($sensor->data_collection[0]->error == true) {
        //         event(new SensorThresholdExceeded($sensor));
        //     }
        // }

        return view('dashboard.show', compact('bridge', 'sensors'));
    }

    public function getSensorsOfBridge($id) {
        $sensors = Sensor::join('sensor_type', 'sensors.sensor_type_id', '=', 'sensor_type.id')
            ->where('bridge_id', $id)
            ->select('sensors.*', 'sensor_type.type', 'sensor_type.data_attribute')
            ->get();


        foreach ($sensors as $sensor) {
            $sensorData = SensorData::where('sensor_id', $sensor->id)
                                ->select('data', 'error', 'created_at', 'threshold_value')
                                ->latest()
                                ->get();
            $dataArr = [];
            foreach ($sensorData as $data) {
                $data->data = json_decode($data->data, true);
                array_push($dataArr, $data);
            }
            $sensor->data_collection = $dataArr;
        }

        return $sensors;
    }
}
