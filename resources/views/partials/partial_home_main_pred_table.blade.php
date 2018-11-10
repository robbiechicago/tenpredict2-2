<div class="col-md-12 pred-table-container">
    <div class="pred-table-inner-div">
        <table id="home-weeks-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Week</th>
                    <th scope="col">My Predictions</th>
                    <th scope="col">My Score</th>
                    <th scope="col">Winner</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeks as $week)
                    @php
                        $now = date('Y-m-d H:i:s');
                        $predictText = $now > $last_game_datetimes[$week->play_week_num] ? 'View predictions' : 'Predict Now';
                        $myWeekRank = new NumberFormatter('en-GB', NumberFormatter::ORDINAL);
                        if (!isset($weeklyScores[$week->play_week_num]['myScore'][0])) {
                            $weeklyScoresText = 'n/a';
                        } else {
                            $weeklyScoresText = $weeklyScores[$week->play_week_num]['highestScore'] == NULL ? '' : $weeklyScores[$week->play_week_num]['myScore'][0]->tot_pts_won . ' ('. $myWeekRank->format($weeklyScores[$week->play_week_num]['myScore'][0]->rank) . ')';
                        }
                        $winnerText = $weeklyScores[$week->play_week_num]['highestScore'] == NULL ? '' : $weeklyScores[$week->play_week_num]['winner'].' ('.$weeklyScores[$week->play_week_num]['highestScore'].')';

                    @endphp
                    <tr>
                        <td>{{ $week->play_week_num }}</td>
                        <td><a href="season/{{ $week->season->season }}/week/{{ $week->play_week_num }}/predictions">{{ $predictText }}</a></td>
                        <td><a href="weekly-scores/{{ $week->id }}">{{ $weeklyScoresText }}</a></td>
                        <td><a href="weekly-scores/{{ $week->id }}">{{ $winnerText }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>