<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Prediction;
use App\Game;
use App\User;
use App\Weeklyscores;
use Auth;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $seasons = Season::with('weeks')->orderBy('season', 'DESC')->get();
        $users = User::get();
        // return $seasons;

        return view('admin.index', [
            'users' => $users,
            'seasons' => $seasons
        ]);
    }

    public function calc_weekly_scores($week_id) {

        $games = Game::where('week_id', $week_id)->where('active', 1)->get();

        $users = User::where('active', 1)->orderBy('id', 'ASC')->get();

        foreach ($users as $user) {
            
            $predictions = Prediction::from('predictions AS p')
                                     ->join('games AS g', 'p.game_id', '=', 'g.id')
                                     ->where('p.user_id', $user->id)
                                     ->where('g.week_id', $week_id)
                                     ->where('p.active', 1)
                                     ->orderBy('p.game_id', 'ASC')
                                     ->get();

            if (count($predictions) < 1) {
                //DID NOT PREDICT
            } else {
                $weekly_scores['num_correct_res'] = 0;
                $weekly_scores['num_correct_scr'] = 0;
                $weekly_scores['pts_bet_res'] = 0;
                $weekly_scores['pts_bet_scr'] = 0;
                $weekly_scores['tot_pts_bet'] = 0;
                $weekly_scores['pts_won_res'] = 0;
                $weekly_scores['pts_won_scr'] = 0;
                $weekly_scores['tot_pts_won'] = 0;
                foreach ($games as $game) {
                    $no_pred = true;
                    foreach ($predictions as $pred) {
                        if ($pred->game_id == $game->id) {
                            $weekly_scores['pts_bet_res'] += $pred->result_points;
                            $weekly_scores['pts_bet_scr'] += $pred->score_points;
                            $weekly_scores['tot_pts_bet'] += ($pred->result_points + $pred->score_points);
                            $calc_pred = $this->calc_pred($pred->home_goals, $pred->away_goals, $pred->result_points, $pred->score_points, $game->final_home, 
                            $game->final_away);
                            $no_pred = false;
                        }
                    }
                    if ($no_pred) {
                        $calc_pred['res_profit'] = -1;
                        $calc_pred['scr_profit'] = -1;
                        $weekly_scores['pts_bet_res'] += 1;
                        $weekly_scores['pts_bet_scr'] += 1;
                        $weekly_scores['tot_pts_bet'] += 2;
                    }
                    $weekly_scores['num_correct_res'] = $calc_pred['res_profit'] > 0 ? $weekly_scores['num_correct_res'] + 1 : $weekly_scores['num_correct_res'];
                    $weekly_scores['num_correct_scr'] = $calc_pred['scr_profit'] > 0 ? $weekly_scores['num_correct_scr'] + 1 : $weekly_scores['num_correct_scr'];
                    $weekly_scores['pts_won_res'] += $calc_pred['res_profit'];
                    $weekly_scores['pts_won_scr'] += $calc_pred['scr_profit'];
                    $weekly_scores['tot_pts_won'] += ($calc_pred['res_profit'] + $calc_pred['scr_profit']);
                }
                $this->update_weekly_scores_table($week_id, $user->id, $weekly_scores);
            }
        }

        return back();

    }

    private function calc_pred($pred_home_goals, $pred_away_goals, $pred_res_pts, $pred_scr_pts, $game_home_goals, $game_away_goals) {
        
        $pred_result = $this->get_result($pred_home_goals, $pred_away_goals);
        $game_result = $this->get_result($game_home_goals, $game_away_goals);
        
        $rtn_array['res_profit'] = $pred_result == $game_result ? (int)$pred_res_pts * 2 : 0 - (int)$pred_res_pts;
        $rtn_array['scr_profit'] = ($pred_home_goals == $game_home_goals && $pred_away_goals == $game_away_goals) ? (int)$pred_scr_pts * 5 : 0 - (int)$pred_scr_pts;
        
        return $rtn_array;

    }

    private function get_result($home_goals, $away_goals) {
        
        if ($home_goals == $away_goals) {
            return 'Draw';
        } elseif ($home_goals > $away_goals) {
            return 'Home Win';
        } elseif ($home_goals < $away_goals) {
            return 'Away Win';
        }
        return false;

    }

    private function update_weekly_scores_table($week_id, $user_id, $weekly_scores) {
        
        $check = Weeklyscores::where('week_id', $week_id)->where('user_id', $user_id)->where('active', 1)->get();

        if (count($check) > 0) {
            //Already exists so update
            $weekly_scores['updated_date'] = date('Y-m-d H:i:s');
            $weekly_scores['updated_by'] = Auth::user()->id;
            return Weeklyscores::where('week_id', $week_id)->where('user_id', $user_id)->where('active', 1)->update($weekly_scores);
        } else {
            //doesn't exist so create
            $weekly_scores['week_id'] = $week_id;
            $weekly_scores['user_id'] = $user_id;
            $weekly_scores['created_date'] = date('Y-m-d H:i:s');
            $weekly_scores['created_by'] = Auth::user()->id;
            return Weeklyscores::insert($weekly_scores);
        }

    }

    public function create_weeks(Request $request) {

        $season_id = $request->input('season_id');

        $season = Season::find($season_id);
        return $season;

    }
}
