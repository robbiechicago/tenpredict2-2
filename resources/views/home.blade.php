@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">

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
</div>
@endsection
