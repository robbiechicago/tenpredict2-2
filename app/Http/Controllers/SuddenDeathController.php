<?php

namespace App\Http\Controllers;

use App\SuddenDeath;
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
        $latest_sd = SuddenDeath::orderBy('id', 'DESC')->first();
        $first_week = $latest_sd->is_first_week($current_week);

        return view('sudden_death.index',[]);
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
