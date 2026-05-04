<?php

namespace App\Http\Controllers;

// use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Account registration
    public function register(Request $req)
    {
        try {
            $validator = Validator::make($req->all(),[
                "name" => "required|string|max:191",
                "email" => "required|string|email|max:191|unique:users",
                "password" => "required|string|min:8|confirmed",
                "role" => "required|string"
            ]);
            if ($validator->fails()) return response()->json(["error" => $validator->errors()],500);
            $user = User::create([
                "name" => $req->name,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "role" => $req->role,
                "login_dt" => "NULL"
            ]);
            return response()->json(["message" => "Account successfuly created"]);
        } catch (\Throwable $e) {
            return response()->json([ "error" => $e->getMessage() ]);
        }
    }
    // Account authentication
    public function login(Request $req)
    {
        try {
            $req->validate([
                "email" => "required|email",
                "password" => "required",
                "role" => "required",
                "login_dt" => "required"
            ]);
            $user = User::where("email",$req->email)->where("role",$req->role)->first();
            if (!$user) return response()->json(["message" => "Account does not exist"],404);
            else if (!Hash::check($req->password,$user->password)) return response()->json(["message" => "Wrong password"],401);
            $user->login_dt = $req->login_dt;
            $user->save();
            return response()->json([
            	"id" => $user->id,
            	"name" => $user->name,
            	"email" => $user->email,
            	"contact" => $user->contact
            ]);
        } catch (\Throwable $e) {
            return response()->json([ "error" => $e->getMessage() ]);
        }
    }
    // Logout an account
    public function logout(Request $req)
    {
        $req->validate(["id" => "required"]);
        $user = User::find($req->id);
        if (!$user) return response()->json(["error" => "Unable to log you out"],401);
        return response()->json(["message" => "Logged out successfuly"]);
    }
    // Reset password
    public function changePassword(Request $req)
    {
    	$req->validate([
    		"email" => "required|email",
    		"password" => "required|confirmed"
    	]);
    	if (!$req) return response()->json(["error" => "Invalid credentials"]);
    	$user = User::where("email",$req->email)->first();
    	if (!$user) return response()->json(["error" => "User not found"],404);
    	$user->password = Hash::make($req->password);
    	$user->save();
    	return response()->json(["message" => "Password has been reset"]);
    }
}




