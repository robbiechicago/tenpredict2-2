<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollVotes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class PollVotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //DO SOME VALIDATION

        //GET VARIABLES
        $user_id = Auth::user()->id;
        $poll_id = $_POST['poll_id'];
        $vote = $_POST['poll_val'];

        //MAKE SURE POLL ID MATCHES A LIVE POLL. ONLY SUBMIT IF IT DOES
        $now = Carbon::now()->toDateTimeString();
        $poll = Poll::whereDate('start_datetime', '<', $now)
                    ->whereDate('end_datetime', '>', $now)
                    ->first();

        if ($poll_id != $poll->id) {
            return 1;
        } 

        //MAKE SURE USER HAS NOT ALREADY VOTED ON THIS POLL.  ONLY SUBMIT IF NOT
        $vote_check = PollVotes::where('poll_id', $poll_id)->where('user_id', $user_id)->get();
        if (count($vote_check) > 0) {
            return 2;
        }

        $new_poll = new PollVotes;
        $new_poll->poll_id = $poll_id;
        $new_poll->user_id = $user_id;
        $new_poll->poll_answers_id = $vote;
        $new_poll->active = 1;
        $new_poll->created_at = $now;

        if ($new_poll->save()) {
            return 3;
        }

        return 4;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PollVotes  $pollVotes
     * @return \Illuminate\Http\Response
     */
    public function show(PollVotes $pollVotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PollVotes  $pollVotes
     * @return \Illuminate\Http\Response
     */
    public function edit(PollVotes $pollVotes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PollVotes  $pollVotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollVotes $pollVotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PollVotes  $pollVotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollVotes $pollVotes)
    {
        //
    }
}
