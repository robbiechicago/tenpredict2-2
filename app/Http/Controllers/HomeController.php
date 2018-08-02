<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Week;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weeks = Week::with('games')->whereHas('games')->orderBy('play_week_num', 'DESC')->get();
    
        return view('home', compact('weeks'));
    }
}
