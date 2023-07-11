<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        try {
            $user = User::create([
                'full_name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // $ownerRole = Role::where('name', 'owner')->first();
            // $user->assignRole($ownerRole);

            return response()->json(["message" => "User successfully added", "user" => $user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["error" => "Failed to register"], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->id != $id) {
            return response()->json(["status"=>'F', "message"=>"You are not authorized to make changes to other users"]);
        }
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $user = User::findOrFail($id);
            $user->update([
                'full_name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $role = Role::where('name', $request->role)->first();
            $user->syncRoles([$role]);

            return response()->json(["message" => "User successfully updated", "user" => $user]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(["error" => "Failed to update user"], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
        $user = JWTAuth::parseToken()->authenticate();

        try {
            $user->delete();
            return response()->json(["message" => "User successfully deleted"]);
        } catch (Exception $e) {
            return response()->json(["error" => "Failed to delete user"], 500);
        }
    }
}
