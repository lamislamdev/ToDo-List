<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    function home()
    {

        return inertia::render('Dashboard');
    }
    function about()
    {
//    return now()->format('Y-m-d');


        $todosToday = Todo::whereDate('created_at', Carbon::today())->get();
        return $todosToday;

    }


}
