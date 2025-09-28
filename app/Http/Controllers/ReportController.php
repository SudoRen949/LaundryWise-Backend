<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
	// Save a new revenue report
	public function add(Request $req)
    {
    	try {
    		$validator = Validator::make($req->all(),[
    			"owner_id" => "required",
				"owner" => "required",
				"value" => "required",
				"week" => "required",
				"month" => "required"
    		]);
    		if ($validator->fails()) return response()->json(["error" => $validator->errors()]);
    		Report::create([
    			"owner_id" => $req->owner_id,
				"owner" => $req->owner,
				"value" => $req->value,
				"week" => $req->week,
				"month" => $req->month
    		]);
    		return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    // Get the specific report revenue to the owner
    public function retrieve($id)
    {
    	try {
    		$report = Report::where("owner_id",$id)->get();
			if (!$report) return response()->json(["error" => "No report data was found for owner " . $id],404);
			return response()->json($report->toArray());
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
}
