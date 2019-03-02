<?php

namespace App\Http\Controllers;

use App\Season;
use App\SuddenDeath;
use App\User;
use App\Week;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuddenDeathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $current_week = Week::current_week();

        $users = User::with('suddenDeathPicks')->get();
        // return $users;

        $all_sd = SuddenDeath::orderBy('start_week_id', 'DESC')->get();
        // return $all_sd;

        $sd_array = [];
        foreach ($all_sd as $key => $value) {
            $sd = SuddenDeath::with('picksByUserWeek.user')->find($all_sd[$key]->id);
            $sd_array[$sd->id]['sd'] = $sd;
            $sd_array[$sd->id]['min_week'] = $sd->picksByUserWeek->min('week_id');
            $sd_array[$sd->id]['max_week'] = $sd->picksByUserWeek->max('week_id');
            $sd_array[$sd->id]['round_status'] = SuddenDeath::round_status($sd->id);
            $sd_array[$sd->id]['players'] = [];
            foreach ($sd->picksByUserWeek as $pick) {
                if (!in_array($pick->user->name, $sd_array[$sd->id]['players'])) {
                    array_push($sd_array[$sd->id]['players'], $pick->user->name);
                }
            }
        }

        // return $sd_array[1];



        

        return view('sudden_death.index',[
            'users' => $users,
            'sd_array' => $sd_array,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuddenDeath  $suddenDeath
     * @return \Illuminate\Http\Response
     */
    public function show(SuddenDeath $suddenDeath)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuddenDeath  $suddenDeath
     * @return \Illuminate\Http\Response
     */
    public function edit(SuddenDeath $suddenDeath)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuddenDeath  $suddenDeath
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuddenDeath $suddenDeath)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuddenDeath  $suddenDeath
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuddenDeath $suddenDeath)
    {
        //
    }
}
