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

        $games = Game::where('week_id', $week_id)
                    ->where('active', 1)
                    ->get();

        $weekly_scores = Weeklyscores::where('week_id', $week_id)->where('active', 1)->orderBy('tot_pts_won', 'DESC')->get();

        $abbrvs = DB::table('team_abbrv')->get();
        $pred_array = array();

        foreach ($games as $k => $v) {
            foreach ($abbrvs as $abbrv) {
                if ($games[$k]->home_team == $abbrv->full_name) {
                    $games[$k]->abbrv_home = $abbrv->abbrv;
                }
                if ($games[$k]->away_team == $abbrv->full_name) {
                    $games[$k]->abbrv_away = $abbrv->abbrv;
                }
            }
        }

        foreach ($weekly_scores as $row) {
            $user = User::find($row->user_id);

            $predictions = Prediction::from('predictions AS p')
                                     ->join('games AS g', 'g.id', '=', 'p.game_id')
                                     ->where('g.week_id', $week_id)
                                     ->where('p.user_id', $row->user_id)
                                     ->where('g.active', 1)
                                     ->where('p.active', 1)
                                     ->orderBy('p.game_id', 'ASC')
                                     ->get();
                                    //  return $predictions;

            $pred_array[$user->name]['username'] = $user->name;
            $pred_array[$user->name]['username'] = $user->name;
            for ($i=1; $i < 11; $i++) { 
                $pred = $predictions[$i - 1];
                // return $pred;
                $pred_array[$user->name][$i]['home_goals'] = $pred->home_goals;
                $pred_array[$user->name][$i]['away_goals'] = $pred->away_goals;
                $pred_result = $this->get_result($pred->home_goals, $pred->away_goals);
                $game_result = $this->get_result($games[$i - 1]->home_goals, $games[$i - 1]->away_goals);
                $pred_array[$user->name][$i]['res_profit'] = $pred_result = $game_result ? (int)$pred->result_points * 2 : 0 - (int)$pred->result_points;
                $pred_array[$user->name][$i]['scr_profit'] = ($pred->home_goals == $games[$i - 1]->home_goals && $pred->away_goals == $games[$i - 1]->away_goals) ? (int)$pred->result_points * 5 : 0 - (int)$pred->score_points;
            }
            $pred_array[$user->name]['tot_pts_bet'] = $row->tot_pts_bet;
            $pred_array[$user->name]['pts_won_res'] = $row->pts_won_res;
            $pred_array[$user->name]['pts_won_scr'] = $row->pts_won_scr;
            $pred_array[$user->name]['tot_pts_won'] = $row->tot_pts_won;
        }

        // return $pred_array;

        return view('pages.weekly_scores', [
            'games' => $games,
            'week_num' => $week_num[0],
            'pred_array' => $pred_array
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
