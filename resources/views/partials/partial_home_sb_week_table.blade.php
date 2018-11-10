<div id="home-rh-table-week" class="col-md-12 home-rh-table">
    <div class="sb-table-inner-div">
        <h3>Week {{ $latest_completed_week_num }} table</h3>
        <em><a href="/weekly-scores/{{ $latest_completed_week_num }}">Click here for full table</a></em>
        <table id="home-league-table" class="table table-sm">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Player</th>
                    <th># Res</th>
                    <th># Scr</th>
                    <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                @for ($w = 0; $w < 5; $w++)
                    @if (isset($latest_week_scores[$w]))
                    <tr>
                        <td>{{ $w + 1 }}</td>
                        <td>{{ $latest_week_scores[$w]['name'] }}</td>
                        <td><center>{{ $latest_week_scores[$w]['num_correct_res'] }}</center></td>
                        <td><center>{{ $latest_week_scores[$w]['num_correct_scr'] }}</center></td>
                        <td><center>{{ $latest_week_scores[$w]['tot_pts_won'] }}</center></td>
                    </tr>
                    @endif
                @endfor
            </tbody>
        </table>
    </div>
</div>