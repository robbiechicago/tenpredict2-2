<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Season;
use App\Week;
use App\Game;
use App\Poll;
use App\Settings;
use App\SuddenDeath;
use App\SuddenDeathPicks;
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
        // $user_id = 10;

        $weeks = Week::with(['games.predictions' => function($query) {
            $user_id = Auth::user()->id; //dont think this can be removed, despite the duplication (scope)
            // $user_id = 10;
            $query->where('predictions.user_id', $user_id);
        }])->whereHas('games')->orderBy('play_week_num', 'DESC')->get();

        // return $weeks;

        $num_predictions = array();
        $last_game_datetimes = array();
        $weeklyScores = array();
        $now = Carbon::now()->toDateTimeString();
        $sd_teams = [];

        foreach ($weeks as $week) {
            //GET CURRENT WEEK
            $week_monday = Carbon::parse($week->week_saturday)->subDays(5)->toDateString();
            $week_sunday = Carbon::parse($week->week_saturday)->addDays(1)->toDateString();
            if ($now > Carbon::parse($week_monday)->startOfDay() && $now < Carbon::parse($week_sunday)->endOfDay()) {
                $current_week = $week->id;
                foreach ($week->games as $game) {
                    array_push($sd_teams, $game->home_team);
                    array_push($sd_teams, $game->away_team);
                }
                sort($sd_teams);
            }

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
            $weeklyScores[$play_week_num]['myScore'] = Weeklyscores::where('week_id', $week->id)->where('user_id', $user_id)->where('active', 1)->get(['tot_pts_won', 'rank']);
            

            if (Weeklyscores::where('week_id', $week->id)->exists()) {

                $week_high_score = Weeklyscores::where('week_id', $week->id)
                                               ->where('active', 1)
                                               ->max('tot_pts_won');
                
                $winner = Weeklyscores::from('weekly_scores AS s')
                                      ->join('users AS u', 's.user_id', '=', 'u.id')
                                      ->where('s.week_id', $week->id)
                                      ->where('s.active', 1)
                                      ->where('s.tot_pts_won', $week_high_score)
                                      ->get(); 

                $weeklyScores[$play_week_num]['highestScore'] = isset($winner) ? $winner[0]->tot_pts_won : NULL;
                if (count($winner) > 1) {
                    $winners = [];
                    foreach ($winner as $row) {
                        array_push($winners, $row->name);
                    }
                    $weeklyScores[$play_week_num]['winner'] = implode(', ', $winners);
                } else {
                    $weeklyScores[$play_week_num]['winner'] = isset($winner) ? $winner[0]->name : NULL;
                }
            } else {
                $weeklyScores[$play_week_num]['highestScore'] = NULL;
                $weeklyScores[$play_week_num]['winner'] = NULL;
            }
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

        $best_rank = Weeklyscores::where('user_id', $user_id)->where('active', 1)->min('rank');
        $best_rank_weeks = Weeklyscores::from('weekly_scores AS ws')
                                       ->join('weeks AS w', 'w.id', '=', 'ws.week_id')
                                       ->where('ws.user_id', $user_id)
                                       ->where('ws.rank', $best_rank)
                                       ->select('w.play_week_num')
                                       ->get();
        
        $best_weeks = [];
        foreach ($best_rank_weeks as $week) {
            array_push($best_weeks, $week->play_week_num);
        }
        $best_weeks_string = implode(', ', $best_weeks);
        $best_week_s = count($best_weeks) > 1 ? 's' : '';

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
        $high_score_weeks = Weeklyscores::from('weekly_scores AS ws')
                                        ->join('weeks AS w', 'w.id', '=', 'ws.week_id')
                                        ->where('ws.user_id', $user_id)
                                        ->where('ws.tot_pts_won', $high_score)
                                        ->select('w.play_week_num')
                                        ->get();
        $hs_best_weeks = [];
        foreach ($high_score_weeks as $week) {
            array_push($hs_best_weeks, $week->play_week_num);
        }
        $hs_best_weeks_string = implode(', ', $hs_best_weeks);
        $hs_best_week_s = count($hs_best_weeks) > 1 ? 's' : '';

        $poll = Poll::with('answers.votes')
                    ->whereDate('start_datetime', '<', $now)
                    ->whereDate('end_datetime', '>', $now)
                    ->first();
        // return $poll;

        //SUDDEN DEATH
        $current_week_sd_pick = '';
        $sd_running = Settings::where('setting', 'sudden_death_on')->value('value');
        if ($sd_running) {   
            $sd = SuddenDeath::orderBy('id', 'DESC')->first();
            if ($current_week >= $sd->start_week_id) {
                // return $sd;
                $first_week = $sd->is_first_week($current_week);
                if ($first_week) {
                    $sd_still_in = true;
                } else {
                    $picks = SuddenDeathPicks::where('user_id', $user_id)->where('sudden_death_id', $sd->id)->orderBy('week_id', 'ASC')->get();
                    if (isset($picks) && count($picks) > 0) {
                        // return $picks;
                        foreach ($picks as $pick) {
                            if ($pick->result == 'lost') {
                                $sd_still_in = false;
                            } else {
                                $sd_still_in = true;
                                if ($pick->week_id == $current_week) {
                                    $current_week_sd_pick = $pick->team_picked;
                                } else {
                                    if (($key = array_search($pick->team_picked, $sd_teams)) !== false) {
                                        unset($sd_teams[$key]);
                                    }
                                }
                            }
                        }
                    } else {
                        $sd_still_in = false;
                    }
                }
                if ($sd_still_in) {

                    // return $sd_teams;
                }
                // return $picks;
                //Get week - need to know if it's the first week of the round
            }
        }


        // return $weeklyScores;

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
            'hs_best_weeks_string' => $hs_best_weeks_string,
            'hs_best_week_s' => $hs_best_week_s,
            'best_rank' => $best_rank,
            'best_weeks_string' => $best_weeks_string,
            'best_week_s' => $best_week_s,
            'poll' => $poll,
            'sd_running' => $sd_running,
            'sd_still_in' => $sd_still_in,
            'sd_teams' => $sd_teams,
            'current_week_sd_pick' => $current_week_sd_pick,
        ]);
    }
}
