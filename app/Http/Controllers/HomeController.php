<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Week;
use App\Game;
use App\Weeklyscores;
use Auth;

use App\Traits\LeagueTrait;


class HomeController extends Controller
{
    use LeagueTrait;

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
        $user_id = Auth::user()->id;

        $weeks = Week::with(['games.predictions' => function($query) {
            $user_id = Auth::user()->id; //dont think this can be removed, despite the duplication (scope)
            $query->where('predictions.user_id', $user_id);
        }])->whereHas('games')->orderBy('play_week_num', 'DESC')->get();

        $num_predictions = array();
        $last_game_datetimes = array();
        $weeklyScores = array();
        foreach ($weeks as $week) {
            //GET NUMBER OF PREDICTIONS
            $play_week_num = $week->play_week_num;
            $num_pred = 0;
            foreach ($week->games as $game) {
                if (isset($game->predictions[0]->id) && $game->predictions[0]->active == 1) {
                    $num_pred ++;
                }
            }
            $num_predictions[$play_week_num] = $num_pred;

            //GET TIME OF FINAL MATCH
            $last_game_datetimes[$play_week_num] = Game::where('week_id', $week->id)->where('active', 1)->max('kickoff_datetime');


            //GET WEEKLY SCORES INFO (my score, my rank, hightest score, winner)
            $weeklyScores[$play_week_num] = array();
            $weeklyScores[$play_week_num]['myScore'] = Weeklyscores::where('week_id', $week->id)->where('user_id', $user_id)->where('active', 1)->value('tot_pts_won');

            $winner = Weeklyscores::from('weekly_scores AS s')
                                  ->join('users AS u', 's.user_id', '=', 'u.id')
                                  ->where('s.week_id', $week->id)
                                  ->where('s.active', 1)
                                  ->orderBy('s.tot_pts_won', 'DESC')
                                  ->first();

            $weeklyScores[$play_week_num]['highestScore'] = isset($winner) ? $winner->tot_pts_won : NULL;
            $weeklyScores[$play_week_num]['winner'] = isset($winner) ? $winner->name : NULL;
        }

        $league = $this->get_league_positions();
        $rank = 0;
        $rank_counter = 0;
        $last_pts = '';
        $my_league_pos = '';
        $my_tot_points = 0;
        foreach ($league as $key => $value) {
            if ($league[$key]['totPoints'] == $last_pts) {
                $rank_counter++;
            } else {
                $rank_counter++;
                $rank = $rank_counter;
            }
            $league[$key]['rank'] = $rank;
            $last_pts = $league[$key]['totPoints'];
            if ($league[$key]['user_id'] == $user_id) {
                $my_league_pos = $rank;
                $my_tot_points = $league[$key]['totPoints'];
            }
        }
        // return $league;

        $latest_completed_week_id = Weeklyscores::max('week_id');
        $latest_completed_week_num = Week::where('id', $latest_completed_week_id)->value('week_num');
        $latest_week_scores = Weeklyscores::from('weekly_scores AS s')
                                          ->join('users AS u', 's.user_id', '=', 'u.id')
                                          ->where('s.week_id', $latest_completed_week_id)
                                          ->where('s.active', 1)
                                          ->orderBy('s.tot_pts_won', 'DESC')
                                          ->get();
        // return $latest_week_scores;
        $high_score = Weeklyscores::where('user_id', $user_id)
                                  ->where('active', 1)
                                  ->max('tot_pts_won');

        return view('home',[
            'weeks' => $weeks,
            'num_predictions' => $num_predictions,
            'last_game_datetimes' => $last_game_datetimes,
            'weeklyScores' => $weeklyScores,
            'league' => $league,
            'my_league_pos' => $my_league_pos,
            'my_tot_points' => $my_tot_points,
            'latest_completed_week_num' => $latest_completed_week_num,
            'latest_week_scores' => $latest_week_scores,
            'high_score' => $high_score,
        ]);
    }
}
