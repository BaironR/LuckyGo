<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page(){
        return view('index');
    }

    public function buyTickets(){
        return view('site.buyTickets');
    }
}
