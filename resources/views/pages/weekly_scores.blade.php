@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h1>Week {{ $week_num }} Scores</h1>

            <table id="weekly-scores-table" class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2"></th>
                        @foreach($games as $game)
                        <th colspan=2>{{ $game->abbrv_home }} {{ $game->final_home }} - {{ $game->final_away }} {{ $game->abbrv_away }}</th>
                        @endforeach
                        <th rowspan="2">Tot Pts Bet</th>
                        <th rowspan="2">Tot Pts Won</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Player</th>
                        @for ($i = 1; $i < 11; $i++)
                            <th>Res</th>
                            <th>Scr</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pred_array as $pred)
                        <tr>
                            <td rowspan="2">{{ $loop->index + 1 }}</td>
                            <td rowspan="2">{{ $pred['username'] }}</td>
                            @for ($i = 1; $i < 11; $i++)
                            <td colspan="2">{{ $pred[$i]['home_goals']}} - {{ $pred[$i]['away_goals'] }} </td>
                            @endfor
                            <td rowspan="2">{{ $pred['tot_pts_bet'] }}</td>
                            <td rowspan="2">{{ $pred['tot_pts_won'] }}</td>
                        </tr>
                        <tr>
                            @for ($i = 1; $i < 11; $i++)
                            <td>{{ $pred[$i]['res_profit']}}</td>
                            <td>{{ $pred[$i]['scr_profit']}}</td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
@endsection
