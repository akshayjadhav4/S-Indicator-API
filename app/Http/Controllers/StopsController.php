<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stops;
use App\Bus;
class StopsController extends Controller
{
    //
    public function createStops(Request $request, $route_id) {
        if (Bus::where('route_id', $route_id)->exists()) {
            $stop = new Stops;
            $stop->route_id = $request->route_id;
            $stop->bus_stopes = $request->bus_stopes;
            $stop->save();
             
            return response()->json([
                "message" => "stops record created"
            ], 201);
        }else {
            return response()->json([
              "message" => "Route not found"
            ], 404);
        }
    }


    public function getAllStops() {
        $stops = Stops::get()->toJson(JSON_PRETTY_PRINT);
        return response($stops, 200);
    }


    public function getStops($id) {
        if (Stops::where('id', $id)->exists()) {
            $stop = Stops::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stop, 200);
          } else {
            return response()->json([
              "message" => "Stop not found"
            ], 404);
          }
    }

    public function updateStops(Request $request, $id) {
        if (Stops::where('id', $id)->exists()) {
            $stops = Stops::find($id);
            $stops->route_id = is_null($request->route_id) ? $stops->route_id : $request->route_id;
            $stops->bus_stopes = is_null($request->bus_stopes) ? $stops->bus_stopes : $request->bus_stopes;
            $stops->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Stops not found"
            ], 404);
            
        }
    }


    public function deleteStops($id) {
        if(Stops::where('id', $id)->exists()) {
          $stops = Stops::find($id);
          $stops->delete();
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Stop not found"
          ], 404);
        }
    }
}
