<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request){
        $request->validate([
            "name" => 'required|string|min:3',
            "email" => 'required|email|max:25|unique:users,email',
            "password" => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'user' => $user,
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>"required|email",
            'password'=>"required|string"
        ]);

        if(!Auth::attempt($request->only('email','password')))

        return response()->json(['message'=>'email or password invalid'],401);

        $user=User::where('email', $request->email)->firstOrFail();
        $token=$user->createToken('auth_Token')->plainTextToken;
        return response()->json(['user'=>$user, 'token'=>$token]);
    }


     public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'logout Successfuly']);
        
    }
   public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8',
            'role' => 'required|string|in:admin,user'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password) ;
        $user->save();
        return response()->json(['message'=>'created', 'user'=>$user]);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return response()->json(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name'=>'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password'=>'required|string|min:8',
            'role'=>'required|string'
        ]);
        $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password'=>Hash::make($request->password),
        'role' => $request->role,
        ]);
        return response()->json(['user'=>$user]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return response()->json(['user'=>$user]);
    }
}
