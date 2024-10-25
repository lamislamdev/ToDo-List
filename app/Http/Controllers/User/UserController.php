<?php

namespace App\Http\Controllers\User;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends Controller
{
    function register(Request $request){

        try {
            $request->validate([
                'name' => 'required | max:20',
                'email' => 'required | max:50 | email | unique:users',
                'password' => 'required'
            ]);
            $requestData = $request->all();
            $requestData['password'] = bcrypt($request->password);

            User::create($requestData);
            return redirect('/login')->with('success','User created successfully');
        }
        catch (Exception $e){
            return response()->json(['error'=>'User already exists']);
        }

    }


    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $requestData = $request->all();
        $ip = $request->ip();

        $user = User::where('email', $requestData['email'])->first();

        if ($user && Hash::check($requestData['password'], $user->password)) {
            $token = JWTToken::encodeJWT($user->email, $user->id);
            $user->update(['ip' => $ip]);;
            return redirect('/dashboard')->with('success','User login successfully')->cookie('token', $token, 60);
        }
        else{
            return response()->json(['error'=>'Unauthorized'], 401);
        }

    }

    function logout(Request $request){
        $token = $request->cookie('token');
        return response()->json(["status"=>"success"])->cookie('token', $token, -1);
    }

    function updateUser(request $request){
        $request->validate([
            'name' => 'required | max:20',
            'email' => 'required | max:50 | email | unique:users',

        ]);

        $id = JWTToken::decodeJWT($request->cookie('token'))->id;

        User::where("id", $id)->update(["name"=>$request->input('name'),"email"=>$request->input('email')]);
        return response()->json(["status"=>"success"]);
    }


    function deleteUser(request $request){

        try {
            $id = JWTToken::decodeJWT($request->cookie('token'))->id;
            Todo::where('user_id', $id)->delete();
            User::destroy($id);
            return response()->json(["status"=>"success"])->cookie('token', $request->cookie('token'), -1);
        }catch (Exception $e){
            return response()->json(['status'=>'something wont worn'], 401);
        }

    }



}
