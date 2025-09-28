<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
	// Adds a service to the database
	public function add(Request $req)
    {
    	try {
    		$validator = Validator::make($req->all(),[
	    		"owner_id" => "required",
	    		"owner" => "required",
	    		"name" => "required",
	    		"banner" => "required|string",
	    		"address" => "required",
	    		"contact" => "required",
	    		"time" => "required",
	    		"prices" => "required",
	    		"qr" => "required"
	    	]);
	    	if ($validator->fails()) return response()->json(["error" => $validator->errors()],500);
	    	$service = Services::create([
	    		"owner_id" => $req->owner_id,
	    		"owner" => $req->owner,
	    		"name" => $req->name,
	    		"address" => $req->address,
	    		"contact" => $req->contact,
	    		"time" => $req->time,
	    		"prices" => $req->prices,
	    		"banner" => $req->banner,
	    		"qr" => $req->qr
	    	]);
	    	return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()]);
    	}
    }
    // Get information about the service
    public function retrieve($id)
    {
    	try {
    		$service = Services::where("owner_id",$id)->get();
	    	if (!$service) return response()->json(["error" => "Could not find service"],404);
	    	return response()->json($service->toArray());
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()]);
    	}
    }
    public function retrieveAll()
    {
        $services = Services::all();
        if (!$services) return response()->json(["error" => "No services available."],404);
        return response()->json($services->toArray());
    }
    // Update service information
    public function update(Request $req)
    {
    	$validator = Validator::make($req->all(),[
    		"id" => "required",
    		"name" => "required",
    		"banner" => "required|string",
    		"address" => "required",
    		"contact" => "required",
    		"time" => "required",
    		"prices" => "required",
    		"qr" => "required"
    	]);
    	if ($validator->fails()) return response()->json(["error" => $validator->errors()],500);
    	$service = Services::find($req->id);
    	if (!$service) return response()->json(["error" => "Could not find Service at ID:" . $req->id],404);
    	$service->name = $req->name;
    	$service->banner = $req->banner;
    	$service->address = $req->address;
    	$service->contact = $req->contact;
    	$service->time = $req->time;
    	$service->prices = $req->prices;
    	$service->qr = $req->qr;
    	$service->save();
    	return response()->json(["message" => "OK"]);
    }
    // Delete a service
    public function destroy($id)
    {
    	$service = Services::find($id);
    	if (!$service) return response()->json(["error" => "Could not found service at ID:" . $id],404);
    	$service->delete();
    	return response()->json(["message" => "OK"]);
    }
}
