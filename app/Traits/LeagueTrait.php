<?php
 
namespace App\Traits;

use App\League;
use App\User;
use App\Weeklyscores;
use Illuminate\Http\Request;
 
trait LeagueTrait {
 
    public function get_league_positions() {
        $userIdsGet = Weeklyscores::where('active', 1)->orderBy('user_id', 'ASC')->select('user_id')->groupBy('user_id')->get();
        $userIds = array();
        foreach ($userIdsGet as $row) {
            array_push($userIds, $row->user_id);
        }

        $totScores = array();
        foreach ($userIds as $user) {
            $totScores[$user]['user_id'] = $user;
            $totScores[$user]['username'] = User::where('id', $user)->where('active', 1)->value('name');
            $totScores[$user]['totPoints'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('tot_pts_won');
            $totScores[$user]['totResPtsBet'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('pts_bet_res');
            $totScores[$user]['numRes'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('num_correct_res');
            $totScores[$user]['resPts'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('pts_won_res');
            $totScores[$user]['totScrPtsBet'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('pts_bet_scr');
            $totScores[$user]['numScr'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('num_correct_scr');
            $totScores[$user]['scrPts'] = Weeklyscores::where('user_id', $user)->where('active', 1)->sum('pts_won_scr');
        }
        
        $totPts = array_column($totScores, 'totPoints');
        array_multisort($totPts, SORT_DESC, $totScores);

        return $totScores;
    }
 
}