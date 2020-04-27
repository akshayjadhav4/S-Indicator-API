<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    //
    public function createLocation(Request $request) {
      if(Location::where('name', $request->name)->where('taluka',$request->taluka)->exists()) {
        return response()->json([
          "message" => "Location already exists."
        ], 404);
      } else {
        $location = new Location;
        $location->name = $request->name;
        $location->district = $request->district;
        $location->taluka = $request->taluka;
        $location->save();
    
        return response()->json([
            "message" => "Location record created"
        ], 201);
      }
    }


    public function getAllLocation() {
        $locations = Location::get()->toJson(JSON_PRETTY_PRINT);
        return response($locations, 200);
    }


    public function getLocation($id) {
        if (Location::where('id', $id)->exists()) {
            $location = Location::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($location, 200);
          } else {
            return response()->json([
              "message" => "Location not found"
            ], 404);
          }
    }


    public function updateLocation(Request $request, $id) {
        if (Location::where('id', $id)->exists()) {
            $location = Location::find($id);
            $location->name = is_null($request->name) ? $location->name : $request->name;
            $location->district = is_null($request->district) ? $location->district : $request->district;
            $location->taluka = is_null($request->taluka) ? $location->taluka : $request->taluka;
            $location->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Location not found"
            ], 404);
            
        }
    }


    public function deleteLocation ($id) {
        if(Location::where('id', $id)->exists()) {
          $location = Location::find($id);
          $location->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Location not found"
          ], 404);
        }
      }
}
