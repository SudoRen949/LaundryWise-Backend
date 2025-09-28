<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    // Creates a new address for the user
    public function add(Request $req)
    {
        try {
            $validator = Validator::make($req->all(),[
                "user" => "required",
                "user_id" => "required",
                "address" => "required",
                "type" => "required"
            ]);
            if (!$validator) response()->json(["error" => $validator->errors()],500);
            Addresses::create([
                "user" => $req->user,
                "user_id" => $req->userId,
                "address" => $req->address,
                "type" => $req->type
            ]);
            return response()->json(["message" => "OK"]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(["error" => $e->getMessage()],500);
        }
    }
    // Returns the address from the user (customer)
    public function retrieve($id)
    {
        try {
            $address = Addresses::where("user_id",$id)->get();
            if (!$address) return response()->json(["error" => "Unable to find item at ID:" . $id],404);
            return response()->json($address->toArray());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(["error" => $e->getMessage()],500);
        }
    }
    public function retrieveAll()
    {
        $address = Addresses::all();
        if (!$address->isEmpty()) return response()->json(["error" => "No address available"],200);
        return response()->json($address->toArray());
    }
    // Deletes a user addres
    public function destroy($id)
    {
        $address = Addresses::find($id);
        if (!$address) response()->json(["error" => "Unable to find item at ID: " . $id],404);
        $address->delete();
        return response()->json(["message" => "OK"]);
    }
    // Edit user address
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "id" => "required",
            "address" => "required",
            "type" => "required",
        ]);
        if (!$validator) response()->json(["error" => $validator->errors()],500);
        $address = Addresses::find($req->id);
        if (!$address) response()->json(["error" => "Unable to find item at ID: " . $id],404);
        $address->address = $req->address;
        $address->type = $req->type;
        $address->save();
        return response()->json(["message" => "OK"]);
    }
}
