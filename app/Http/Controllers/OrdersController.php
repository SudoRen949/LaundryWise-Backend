<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
	// Creates a list of orders
    public function add(Request $req)
    {
    	try {
    		$validator = Validator::make($req->all(),[
	    		"customer" => "required",
	        	"customer_id" => "required",
	        	"contact" => "required",
	        	"address" => "required",
	        	"service" => "required",
	        	"service_owner" => "required",
	        	"service_owner_id" => "required",
	        	"shop_name" => "required",
	        	"payment_type" => "required",
	        	"pickup_date" => "required",
	        	"pickup_time" => "required",
	        	"total_payment" => "required",
	        	"reference_code" => "required",
	        	"date_ordered" => "required",
	    	]);
	    	if ($validator->fails()) return response()->json(["error" => $validator->errors()],500);
	    	Orders::create([
	    		"customer" => $req->customer,
	        	"customer_id" => $req->customer_id,
	        	"contact" => $req->contact,
	        	"address" => $req->address,
	        	"service" => $req->service,
	        	"service_owner" => $req->service_owner,
	        	"service_owner_id" => $req->service_owner_id,
	        	"shop_name" => $req->shop_name,
	        	"payment_type" => $req->payment_type,
	        	"pickup_date" => $req->pickup_date,
	        	"pickup_time" => $req->pickup_time,
	        	"total_payment" => $req->total_payment,
	        	"reference_code" => $req->reference_code,
	        	"date_ordered" => $req->date_ordered,
	        	"status" => "Pending for pickup"
	    	]);
	    	return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    // Returns all pending orders to owner
    public function retrieveOwner($id)
    {
    	$orders = Orders::where("service_owner_id",$id)->get();
    	if (!$orders) return response()->json(["error" => "No pending orders."],404);
    	return response()->json($orders->toArray());
    }
    // Returns all pending customer orders 
    public function retrieveCustomer($id)
    {
    	$orders = Orders::where("customer_id",$id)->get();
    	if (!$orders) return response()->json(["error" => "No pending orders."],404);
    	return response()->json($orders->toArray());
    }
    // Returns all pending orders
    public function retrieveAll()
    {
    	$orders = Orders::all();
    	if (!$orders) return response()->json(["error" => "No pending orders."],404);
    	return response()->json($orders->toArray());
    }
    // Update order status
    public function updateStatus(Request $req) {
    	$val = Validator::make($req->all(),[
    		"customer_id" => "required",
    		"new_status" => "required"
    	]);
    	if ($val->fails()) return response()->json(["error" => $val->errors()],500);
    	$order = Orders::where("customer_id",$req->customer_id)->first();
    	if (!$order) return response()->json(["error" => "Customer not found."],404);
    	$order->status = $req->new_status;
    	$order->save();
    	return response()->json(["message" => "OK"]);
    }
    // Delete a customer order
    public function destroy($id)
    {
    	try {
    		$order = Orders::where("customer_id",$id)->first();
	    	if (!$order) return response()->json(["error" => "Could not find order at ID:" . $customer_id],404);
	    	$order->delete();
	    	return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
}
