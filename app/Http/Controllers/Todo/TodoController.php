<?php

namespace App\Http\Controllers\Todo;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;


class TodoController extends Controller
{
    function addTodo(Request $request){
        $request->validate([
           "title" => "required",
        ]);
        $user_id = JWTToken::decodeJWT($request->cookie('token'))->id;

        Todo::create([ 'user_id'=>$user_id ,'title'=>$request->input('title') ]);

        return response()->json(["status"=>"success"]);

    }

    function toadyTodo(Request $request)
    {
       $currentTodo = Todo::where('user_id',JWTToken::decodeJWT($request->cookie('token'))->id)
           ->whereDate('created_at', Carbon::today())->where('status' , 'success')->get();

       return $currentTodo;

    }

    function checkTodo(Request $request){
        try {
            Todo::where('user_id',JWTToken::decodeJWT($request->cookie('token'))->id)
                ->where('id',$request->input('id'))->update(['status'=>'success']);
            return response()->json(["status"=>"success"]);
        }catch (Exception $e){
            return response()->json(["status"=>"Something went wrong"]);
        }
    }

    function deleteTodo(Request $request){
        try {
            Todo::where('user_id',JWTToken::decodeJWT($request->cookie('token'))->id)
                ->where('id',$request->input('id'))->delete();
            return response()->json(["status"=>"success"]);
        }catch (Exception $e){
            return response()->json(["status"=>"Something went wrong"]);
        }
    }




}
