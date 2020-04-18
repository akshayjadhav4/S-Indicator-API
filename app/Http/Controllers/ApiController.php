<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bus;
class ApiController extends Controller
{
    //
    public function createBus(Request $request) {
        // logic to create a  record goes here
        $bus = new Bus;
        $bus->bus_id = $request->bus_id;
        $bus->route_id = $request->route_id;
        $bus->source = $request->source;
        $bus->destination = $request->destination;
        $bus->depature_time = $request->depature_time;
        $bus->arivel_time = $request->arivel_time;
        $bus->bus_type = $request->bus_type;
        $bus->is_Local = $request->is_Local;
        $bus->save();

        return response()->json([
            "message" => "Bus record created"
        ], 201);

        
    }

    public function getAllBuses() {
        // logic to get all buses goes here
        $buses = Bus::get()->toJson(JSON_PRETTY_PRINT);
        return response($buses, 200);
    }


    
       
    public function getBus($id) {
            if (Bus::where('id', $id)->exists()) {
                $bus = Bus::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($bus, 200);
              } else {
                return response()->json([
                  "message" => "Bus not found"
                ], 404);
                }
    }

    public function getLocalBus($is_Local) {
      if (Bus::where('is_Local', $is_Local)->exists()) {
          $bus = Bus::where('is_Local', $is_Local)->get()->toJson(JSON_PRETTY_PRINT);
          return response($bus, 200);
        } else {
          return response()->json([
            "message" => "Bus not found"
          ], 404);
          }
}

    public function getBusByLocation($source , $destination) {
        if (Bus::where('source', $source)->where('destination',$destination)->exists()) {
            $busOnRoute = Bus::where('source', $source)->where('destination',$destination)->get()->toJson(JSON_PRETTY_PRINT);
            return response($busOnRoute, 200);
          } else {
            return response()->json([
              "message" => "Bus not found  for this route."
            ], 404);
            }
    }

    public function updateBus(Request $request, $id) {
        if (Bus::where('id', $id)->exists()) {
            $bus = Bus::find($id);
            $bus->route_id = is_null($request->route_id) ? $bus->route_id : $request->route_id;
            $bus->source = is_null($request->source) ? $bus->source : $request->source;
            $bus->destination = is_null($request->destination) ? $bus->destination : $request->destination;
            $bus->depature_time = is_null($request->depature_time) ? $bus->depature_time : $request->depature_time;
            $bus->arivel_time = is_null($request->arivel_time) ? $bus->arivel_time : $request->arivel_time;
            $bus->bus_type = is_null($request->bus_type) ? $bus->bus_type : $request->bus_type;
            $bus->is_Local = is_null($request->is_Local) ? $bus->is_Local : $request->is_Local;
            $bus->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Bus not found"
            ], 404);
            
        }
    }

    public function deleteBus ($id) {
        if(Bus::where('id', $id)->exists()) {
          $bus = Bus::find($id);
          $bus->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Bus not found"
          ], 404);
        }
      }
     
}
