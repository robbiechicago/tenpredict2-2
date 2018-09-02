<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use App\Week;
use App\Prediction;
use App\Weeklyscores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklyscoresController extends Controller
{
    public function index() {
        //
    }

    public function show($week_id)
    {
        $week_num = Week::where('id', $week_id)->pluck('play_week_num');

        $games = Game::from('games AS g')
                    ->leftJoin('team_abbrv AS th', 'th.full_name', '=', 'g.home_team')
                    ->leftJoin('team_abbrv AS ta', 'ta.full_name', '=', 'g.away_team')
                    ->where('week_id', $week_id)
                    ->where('active', 1)
                    ->orderBy('kickoff_datetime', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->select(['g.*', 'th.abbrv AS home_abbrv', 'ta.abbrv AS away_abbrv'])
                    ->get();

        $weekly_scores = Weeklyscores::where('week_id', $week_id)->where('active', 1)->orderBy('tot_pts_won', 'DESC')->get();

        $abbrvs = DB::table('team_abbrv')->get();
        $pred_array = array();

        $minGameId = $games->min('id');
        $maxGameId = $games->max('id');

        foreach ($weekly_scores as $row) {
            $user = User::find($row->user_id);

            $predictions = Prediction::from('predictions AS p')
                                     ->join('games AS g', 'g.id', '=', 'p.game_id')
                                     ->where('g.week_id', $week_id)
                                     ->where('p.user_id', $row->user_id)
                                     ->where('g.active', 1)
                                     ->where('p.active', 1)
                                     ->orderBy('g.kickoff_datetime', 'ASC')
                                     ->orderBy('g.id', 'ASC')
                                     ->get();


            $pred_array[$user->name]['username'] = $user->name;
            $i = 1;
            foreach ($games as $game) {
                $no_pred = true;
                //GET PREDICTION WHERE GAME ID IS $i
                foreach ($predictions as $pred) {
                    if ($pred->game_id == $game->id) {

                        $no_pred = false;

                        $pred_array[$user->name][$game->id]['kickoff_datetime'] = $pred->kickoff_datetime;
                        $pred_array[$user->name][$game->id]['home_goals'] = $pred->home_goals;
                        $pred_array[$user->name][$game->id]['away_goals'] = $pred->away_goals;
                        $pred_array[$user->name][$game->id]['final_home'] = $pred->final_home;
                        $pred_array[$user->name][$game->id]['final_away'] = $pred->final_away;
                        $pred_result = $this->get_result($pred->home_goals, $pred->away_goals);
                        $game_result = $this->get_result($pred->final_home, $pred->final_away);
                        $pred_array[$user->name][$game->id]['pred_result'] = $pred_result;
                        $pred_array[$user->name][$game->id]['game_result'] = $game_result;
                        $pred_array[$user->name][$game->id]['res_pts_bet'] = $pred->result_points;
                        $pred_array[$user->name][$game->id]['res_profit'] = $pred_result == $game_result ? (int)$pred->result_points * 2 : 0 - (int)$pred->result_points;
                        $pred_array[$user->name][$game->id]['res_result'] = $pred_result == $game_result ? 'CORRECT RESULT' : 'wrong result';
                        $pred_array[$user->name][$game->id]['scr_pts_bet'] = $pred->score_points;
                        $pred_array[$user->name][$game->id]['scr_profit'] = ($pred->home_goals == $pred->final_home && $pred->away_goals == $pred->final_away) ? (int)$pred->score_points * 5 : 0 - (int)$pred->score_points;
                        $pred_array[$user->name][$game->id]['scr_result'] = ($pred->home_goals == $pred->final_home && $pred->away_goals == $pred->final_away) ? 'CORRECT SCORE' : 'wrong score';
                    }
                    
                }
                    
                if ($no_pred) {
                    
                    $pred_array[$user->name][$game->id]['home_goals'] = '';
                    $pred_array[$user->name][$game->id]['away_goals'] = '';
                    $pred_array[$user->name][$game->id]['res_pts_bet'] = 1;
                    $pred_array[$user->name][$game->id]['res_profit'] = -1;
                    $pred_array[$user->name][$game->id]['scr_pts_bet'] = 1;
                    $pred_array[$user->name][$game->id]['scr_profit'] = -1;
                    
                }
                $i++;
            }
            $pred_array[$user->name]['tot_pts_bet'] = $row->tot_pts_bet;
            $pred_array[$user->name]['num_correct_res'] = $row->num_correct_res;
            $pred_array[$user->name]['pts_won_res'] = $row->pts_won_res;
            $pred_array[$user->name]['num_correct_scr'] = $row->num_correct_scr;
            $pred_array[$user->name]['pts_won_scr'] = $row->pts_won_scr;
            $pred_array[$user->name]['tot_pts_won'] = $row->tot_pts_won;

        }
        // return $pred_array;

        return view('pages.weekly_scores', [
            'week_num' => $week_num[0],
            'games' => $games,
            'pred_array' => $pred_array,
        ]);
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
}
