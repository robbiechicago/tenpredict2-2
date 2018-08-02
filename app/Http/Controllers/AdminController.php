<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $seasons = Season::with('weeks')->orderBy('season', 'DESC')->get();
        // return $seasons;

        return view('admin.index', compact('seasons'));
    }

    public function create_weeks(Request $request) {

        $season_id = $request->input('season_id');

        $season = Season::find($season_id);
        return $season;

    }
}
