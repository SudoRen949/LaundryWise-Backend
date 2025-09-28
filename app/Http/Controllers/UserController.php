<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Delete a specified user
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(["error" => "User not found"],404);
        $user->delete();
        return response()->json(["message" => "User deleted successfuly"]);
    }
    // Modify user preferences
    public function modify(Request $req)
	{
		$req->validate([
			"id" => "required",
			"name" => "required",
			"email" => "required|email",
			"contact" => "required",
			"address" => "required"
		]);
		$user = User::find($req->id);
		if (!$user) return reponse()->json(["error" => "Could not find user",404]);
		$user->name = $req->name;
		$user->email = $req->email;
		$user->contact = $req->contact;
		$user->address = $req->address;
		$user->save();
		return response()->json(["message" => "User has been modified"]);
	}
	// Retrieves user data
	public function retrieve($id)
	{
		$user = User::find($id);
		if (!$user) return response()->json(["error" => "Unable to retrieve data, user not found"],404);
		return response()->json([
			"id" => $user->id,
			"name" => $user->name,
			"email" => $user->email,
			"role" => $user->role,
			"profile" => $user->profile,
			"address" => $user->address,
			"contact" => $user->contact,
		]);
	}
    public function retrieveAll()
    {
        $user = User::all();
        if (!$user) return response()->json(["No users currently in."],404);
        return response()->json($user->toArray());
    }
	// Search user using email
	public function searchMail(Request $req)
	{
		$req->validate(["email" => "required|email"]);
		if (!$req) return response()->json(["error" => "Invalid credentials",401]);
		$user = User::where("email",$req->email)->first();
		if (!$user) return response()->json(["error" => "User with this email does not exist",404]);
		return response()->json(["message" => "ok"]);
	}
	// Changes user profile picture
	public function changeProfile(Request $req)
	{
		$req->validate([
			"id" => "required",
			"profile" => "required|string"
		]);
		$user = User::find($req->id);
		if (!$user) return response()->json(["error" => "Could not save profile picture, user not found",404]);
		$user->profile = $req->profile;
		$user->save();
		return response()->json(["message" => "Profile picture has been updated"]);
	}
}
