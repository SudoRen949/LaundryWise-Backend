<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    public function login(Request $req)
    {
    	try {
    		$req->validate([
    			"email" => "required|email",
    			"password" => "required"
    		]);
    		$admin = Admins::where("email",$req->email)->first();
    		if (!$admin) return response()->json(["error" => "Admin account does not exist"],404);
    		else if (!Hash::check($req->password,$admin->password)) return response()->json(["error" => "Incorrect password"],401);
    		return response()->json([
    			"id" => $admin->id,
    			"name" => $admin->name,
    			"email" => $req->email
    		]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    public function register(Request $req)
    {
    	try {
    		$validator = Validator::make($req->all(),[
    			"name" => "required|max:191",
    			"email" => "required|email",
    			"password" => "required|min:8|confirmed",
                "profile" => "required"
    		]);
    		if ($validator->fails()) return response()->json(["error" => $validator->errors()],500);
            $check = Admins::where("email",$req->email)->first();
            if ($check) return response()->json(["error" => "Account already exist in this email."]);
    		Admins::create([
    			"name" => $req->name,
    			"email" => $req->email,
    			"password" => Hash::make($req->password)
    		]);
    		return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    public function destroy($id)
    {
    	try {
    		$admin = Admins::find($id);
    		if (!$admin) return response()->json(["error" => "Could not find account at ID:" . $id],404);
    		$admin->delete();
    		return response()->json(["message" => "OK"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    public function logout(Request $req)
    {
    	try {
    		$req->validate(["id" => "required"]);
		    $admin = Admins::find($req->id);
		    if (!$admin) return response()->json(["error" => "Unable to log you out"],401);
		    return response()->json(["message" => "Logged out successfuly"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    public function changePassword(Request $req)
    {
    	try {
    		$req->validate([
				"email" => "required|email",
				"password" => "required|confirmed"
			]);
			if (!$req) return response()->json(["error" => "Invalid credentials"],401);
			$admin = Admins::where("email",$req->email)->first();
			if (!$admin) return response()->json(["error" => "User not found"],404);
			$admin->password = Hash::make($req->password);
			$admin->save();
			return response()->json(["message" => "Password has been reset"]);
    	} catch (\Exception $e) {
    		\Log::error($e->getMessage());
    		return response()->json(["error" => $e->getMessage()],500);
    	}
    }
    public function changeProfile(Request $req)
    {
        try {
            $req->validate([
                "id" => "required",
                "profile" => "required|string"
            ]);
            $admin = Admins::find($req->id);
            if (!$admin) return response()->json(["error" => "Admin account not found"],404);
            $admin->profile = $req->profile;
            $admin->save();
            return response()->json(["message" => "OK"]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(["error" => $e->getMessage()],500);
        }
    }
    public function searchMail(Request $req)
    {
        try {
            $req->validate(["email" => "required|email"]);
            if (!$req) return response()->json(["error" => "Email is required"],401);
            $admin = Admins::where("email",$req->email)->first();
            if (!$admin) return response()->json(["error" => "Email not found."],404);
            return response()->json($admin->toArray());
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(["error" => $e->getMessage()],500);
        }
    }
    public function retrieve($id)
    {
        $admin = Admins::find($id);
        if (!$admin) return response()->json(["error" => "No userdata found"],500);
        return ($admin->toArray());
    }
}
