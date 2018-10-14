@extends('layouts.layout')

@section('content')
<div class="container-fluid">

    <div id="home-container" class="row justify-content-center">
        
        <div class="col-lg-8">
            
            <div class="row">
                <h1>Welcome back, {{ Auth::user()->name }}!</h1>
            </div>

            <div class="row ">
                <div class="col-md-4">
                    <div class="home-data-box">
                        <div class="home-data-box-heading">Total Points</div>
                        <div class="home-data-box-data">{{ $my_tot_points }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-data-box">
                        <div class="home-data-box-heading">League Position</div>
                        <div class="home-data-box-data">{{ $my_league_pos }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-data-box">
                        <div class="home-data-box-heading">Highest Score</div>
                        <div class="home-data-box-data">{{ $high_score }}</div>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="home-data-box">
                        <div class="home-data-box-heading">Best Weekly Place</div>
                        <div class="home-data-box-data">{{ $best_rank }} (week{{ $best_week_s }} {{ $best_weeks_string }})</div>
                    </div>
                </div> --}}
            </div>

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

                            $weeklyScoresText = $weeklyScores[$week->play_week_num]['highestScore'] == NULL ? '' : $weeklyScores[$week->play_week_num]['myScore'];
                            $winnerText = $weeklyScores[$week->play_week_num]['highestScore'] == NULL ? '' : $weeklyScores[$week->play_week_num]['highestScore'].' ('.$weeklyScores[$week->play_week_num]['winner'].')';

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

        <div class="col-md-4">

            <div class="row">
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
            </div>

            <div class="row">
                <div id="home-rh-table-week" class="col-md-12 home-rh-table">
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
                                    <td>{{ $latest_week_scores[$w]['num_correct_res'] }}</td>
                                    <td>{{ $latest_week_scores[$w]['num_correct_scr'] }}</td>
                                    <td>{{ $latest_week_scores[$w]['tot_pts_won'] }}</td>
                                </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
