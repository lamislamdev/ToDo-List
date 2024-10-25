<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{

    function dashboard()
    {

        return inertia::render('Dashboard');
    }
    function login()
    {

        return inertia::render('Login');
    }
    function about()
    {
//    return now()->format('Y-m-d');


        $todosToday = Todo::whereDate('created_at', Carbon::today())->get();
        return $todosToday;

    }


}
