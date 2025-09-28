<?php

namespace App\Http\Controllers;

use App\Models\Notifs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotifsController extends Controller
{
	// Sends notification to a target user (Owner/Customer)
    public function send(Request $req)
    {
    	try {
    		$v = Validator::make($req->all(),[
	  			"date" => "required",
	  			"from" => "required",
	  			"to" => "required",
	  			"details" => "required"
	    	]);
	    	if ($v->fails()) return reponse()->json(["error" => $v->errors()],500);
	    	Notifs::create([
	    		"date" => $req->date,
	    		"from" => $req->from,
	    		"to" => $req->to,
	    		"details" => $req->details
	    	]);
	    	return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    // Returns the notifications to user (Owner/Customer)
    public function retrieve($id)
    {
    	try {
    		$notif = Notifs::where("to",$id)->get();
	    	if (!$notif) return response()->json(["error" => "Unable to find user " . $id],404);
	    	return response()->json($notif->toArray());
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return responser()->json(["error" => $e->getMessage()],500);
    	}
    }
    // Deletes notification from a target user (Owner/Customer)
    public function destroy($id)
    {
    	try {
    		$notif = Notifs::find($id);
    		if (!$notif) return response()->json(["error" => "Unable to find user from ID" . $id],404);
    		$notif->delete();
	    	return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
}
