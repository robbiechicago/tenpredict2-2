<div id="home-rh-table-league" class="col-md-12 home-rh-table">
    <h3>League table</h3>
    <em><a href="/league">Click here for full table</a></em>
    <table id="home-league-table" class="table table-sm">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Player</th>
                <th>Week {{ $latest_completed_week_num }} score</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            @for ($l = 0; $l < 5; $l++)
                @if (isset($league[$l]))
                    @php 
                    $user_latest_score = 'n/a';
                    foreach ($latest_week_scores as $user) {
                        if ($user->user_id == $league[$l]['user_id']) {
                            $user_latest_score = $user->tot_pts_won;
                        }
                    }
                    @endphp
                    <tr>
                        <td>{{ $league[$l]['rank'] }}</td>
                        <td>{{ $league[$l]['username'] }}</td>
                        <td>{{ $user_latest_score }}</td>
                        <td>{{ $league[$l]['totPoints'] }}</td>
                    </tr>
                @endif
            @endfor
        </tbody>
    </table>
</div>