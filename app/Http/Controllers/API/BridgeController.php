<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Bridge as BridgeResource;

use App\Models\Bridge;
use App\Models\Sensor;
use App\Models\SensorData;
use App\Models\User;
use App\Models\UserBridge;
use App\Models\Device;

class BridgeController extends BaseController
{
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
                        ->latest()
                        ->get();

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
        

        return $this->sendResponse(BridgeResource::collection($bridges), 'Bridges retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::where('bridge_id', $id);
        if ($device->first()) {
            $bridge = Bridge::join('devices', 'bridges.id', '=', 'devices.bridge_id')
            ->join('user_bridge', 'bridges.id', '=', 'user_bridge.bridge_id')
            ->where('bridges.id', $id)
            ->select('bridges.*', 'devices.ttn_dev_id')
            ->first();
        } else {
            $bridge = Bridge::join('user_bridge', 'bridges.id', '=', 'user_bridge.bridge_id')
                ->where('bridges.id', $id)
                ->first();
        }

        $sensors = $this->getSensorsOfBridge($id);
        $bridge->sensors = $sensors;

        if (is_null($bridge)) {
            return $this->sendError('Bridge not found.');
        }
   
        return $this->sendResponse(new BridgeResource($bridge), 'Bridge retrieved successfully.');
    }

    public function getSensorsOfBridge($id) {
        $sensors = Sensor::join('sensor_type', 'sensors.sensor_type_id', '=', 'sensor_type.id')
            ->join('devices', 'sensors.device_id', '=', 'devices.id')
            ->where('devices.bridge_id', $id)
            ->select('sensors.*', 'sensor_type.type', 'sensor_type.data_attribute', 'devices.ttn_dev_id')
            ->get();


        foreach ($sensors as $sensor) {
            $sensorData = SensorData::where('sensor_id', $sensor->id)
                                ->select('data', 'error', 'created_at', 'threshold_value')
                                ->latest()
                                ->get();
            $dataArr = [];
            foreach ($sensorData as $data) {
                array_push($dataArr, $data);
            }
            $sensor->data_collection = $dataArr;
        }

        return $sensors;
    }
}
