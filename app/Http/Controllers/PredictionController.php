<?php

namespace App\Http\Controllers;

use App\Prediction;
use App\Game;
use App\Season;
use App\Week;
use Illuminate\Http\Request;
use Auth;

class PredictionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function show(Prediction $prediction)
    {
        dd($prediction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function edit(Prediction $prediction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prediction $prediction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prediction  $prediction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prediction $prediction)
    {
        //
    }

    public function tot_points_week($game_id) {

        $user_id = Auth::user()->id;
        $week_id = Game::where('id', $game_id)->pluck('week_id');

        $res_points =  Prediction::join('games', 'games.id', '=', 'predictions.game_id')
                            ->where('predictions.user_id', $user_id)
                            ->where('games.week_id', $week_id)
                            ->where('games.active', 1)
                            ->where('predictions.active', 1)
                            ->sum('result_points');

        $scr_points =  Prediction::join('games', 'games.id', '=', 'predictions.game_id')
                            ->where('predictions.user_id', $user_id)
                            ->where('games.week_id', $week_id)
                            ->where('games.active', 1)
                            ->where('predictions.active', 1)
                            ->sum('score_points');

        return $res_points + $scr_points;

    }

    public function predictions_by_season_week ($season, $week) {

        $season_id = Season::where('season', $season)->value('id');
        $week_id = Week::where('season_id', $season_id)->where('play_week_num', $week)->value('id');
        
        $games = Game::with(['predictions' => function($query) {
                                $query->where('user_id', auth()->user()->id);
                            }])
                        ->where('season_id', $season_id)
                        ->where('week_id', $week_id)
                        ->orderBy('game_num', 'ASC')
                        ->get();
        
        return view('predictions.show', [
            'games' => $games, 
            'week' => $week
        ]);
    }

    public function submit() {
        // return $_POST;

        //DO SOME VALIDATION

        //GET VARIABLES
        $user_id = Auth::user()->id;
        $game_id = $_POST['game_id'];

        $home_goals = $_POST['home_goals'];
        $away_goals = $_POST['away_goals'];
        $res_points = $_POST['res_points'];
        $scr_points = $_POST['scr_points'];

        $input_pred = array();
        $input_pred['home_goals'] = $home_goals;
        $input_pred['away_goals'] = $away_goals;
        $input_pred['result_points'] = $res_points;
        $input_pred['score_points'] = $scr_points;

        //GET THE CORRESPONDING GAME INFO
        $game = Game::where('id', $game_id)->first();

        $pred_is_ok = $this->input_valid_check($game, $input_pred);
    
        if ($pred_is_ok) {
            //CHECK EXISTING PRED
            $pred_check = Prediction::where('game_id', $game_id)->where('user_id', $user_id)->where('active', 1)->pluck('id');

            if (count($pred_check) > 0) {
                //IF THERE IS AN EXISTING PREDICTION, CHECK TO SEE IF THERE ARE ANY DIFFERENCES
                $pred_has_changed = $this->check_for_changes($pred_check, $input_pred);
                if ($pred_has_changed) {
                    $this->update_pred($pred_check, $input_pred);
                }
            } else {
                //IF THERE IS NOT AN EXISTING PREDICTION, CREATE ONE
                $this->new_pred($game_id, $user_id, $input_pred);
            }
        }

        return 'success';

    }

    public function submitx(Request $request) {

        $user = Auth::user();
        $input = $request->all();
        
        //LOOP THROUGHT EACH GAME IN THE PREDICTION FORM
        for ($i=1; $i < 11; $i++) { 
            
            //VALIDATE THE INPUT
            $this->validate($request, [
                "game_".$i."['home_goals']" => 'min:0|max:15|required_with:away_goals_'.$i.', result_points_'.$i.', score_points_'.$i,
                "game_".$i."['away_goals']" => 'min:0|max:15|required_with:home_goals_'.$i.', result_points_'.$i.', score_points_'.$i,
                "game_".$i."['result_points']" => 'numeric|min:1|max:10|required_with:home_goals_'.$i.', away_goals_'.$i.', score_points_'.$i,
                "game_".$i."['score_points']" => 'numeric|min:1|max:10|required_with:home_goals_'.$i.', away_goals_'.$i.', result_points_'.$i
            ]);
        }
            
        for ($i=1; $i < 11; $i++) {
            
            $input_pred = $input['game_'.$i];

            //GET THE CORRESPONDING GAME INFO
            $game = Game::where('id', $input_pred['game_id'])->first();

            //CHECK THE INPUT FOR NULLS OR DATE/TIME OR WHATEVS
            $pred_is_ok = $this->input_valid_check($game, $input_pred);
    
            if ($pred_is_ok) {

                //SEE IF THERE'S ALREADY A PREDICTION FOR THIS GAME AND USER
                $pred_check = Prediction::where('game_id', $game->id)->where('user_id', $user->id)->where('active', 1)->pluck('id');
                
                if (count($pred_check) > 0) {
                    //IF THERE IS AN EXISTING PREDICTION, CHECK TO SEE IF THERE ARE ANY DIFFERENCES
                    $pred_has_changed = $this->check_for_changes($pred_check, $input_pred);
                    if ($pred_has_changed) {
                        $this->update_pred($pred_check, $input_pred);
                    }
                } else {
                    //IF THERE IS NOT AN EXISTING PREDICTION, CREATE ONE
                    $this->new_pred($game->id, $user->id, $input_pred);
                }

            } 
            
        }

        return back();

    }

    private function input_valid_check($game, $input_pred) {
        $now = date('Y-m-d H:i:s');
        if ($now > $game->kickoff_datetime) {
            // var_dump($now);
            // var_dump($game->kickoff_datetime);
            // die('here1');
            return false;
        }
        if (!is_numeric($input_pred['home_goals']) || is_null($input_pred['home_goals']) || $input_pred['home_goals'] < 0 || $input_pred['home_goals'] > 15 || $input_pred['home_goals'] == '') {
            // var_dump($input_pred['home_goals']);
            // die('here2');
            return false;
        } 
        if (!is_numeric($input_pred['away_goals']) || is_null($input_pred['away_goals']) || $input_pred['away_goals'] < 0 || $input_pred['away_goals'] > 15 || $input_pred['away_goals'] == '') {
            // var_dump($input_pred['away_goals']);
            // die('here3');
            return false;
        }
        if (!is_numeric($input_pred['result_points']) || is_null($input_pred['result_points']) || $input_pred['result_points'] < 1 || $input_pred['result_points'] > 10 || $input_pred['result_points'] == '') {
            // var_dump($input_pred['result_points']);
            // die('here4');
            return false;
        }
        if (!is_numeric($input_pred['score_points']) || is_null($input_pred['score_points']) || $input_pred['score_points'] < 1 || $input_pred['score_points'] > 10 || $input_pred['score_points'] == '') {
            // var_dump($input_pred['score_points']);
            // die('here5');
            return false;
        }
        return true;
    }

    private function check_for_changes($pred_id, $input_pred) {
        $existing_pred = Prediction::where('id', $pred_id)->first();
        if ($existing_pred->home_goals == $input_pred['home_goals'] && $existing_pred->away_goals == $input_pred['away_goals'] && $existing_pred->result_points == $input_pred['result_points'] && $existing_pred->score_points == $input_pred['score_points']) {
            return false;
        }
        return true;
    }

    private function update_pred($pred_id, $input_pred) {
        $pred = Prediction::where('id', $pred_id)->first();

        $pred->home_goals = $input_pred['home_goals'];
        $pred->away_goals = $input_pred['away_goals'];
        $pred->result_points = $input_pred['result_points'];
        $pred->score_points = $input_pred['score_points'];

        return $pred->save();
    }

    private function new_pred($game_id, $user_id, $input_pred) {
        $pred = new Prediction;

        $pred->game_id = $game_id;
        $pred->user_id = $user_id;
        $pred->home_goals = $input_pred['home_goals'];
        $pred->away_goals = $input_pred['away_goals'];
        $pred->result_points = $input_pred['result_points'];
        $pred->score_points = $input_pred['score_points'];

        return $pred->save();
    }
}
