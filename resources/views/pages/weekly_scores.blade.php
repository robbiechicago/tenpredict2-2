@extends('layouts.layout')

@section('weekly-table-page')
<div class="">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h1>Week {{ $week_num }} Scores</h1>

            <table id="weekly-scores-table" class="table">
                <thead>
                    <tr>
                        <th colspan="3" class="no-btm-bord"></th>
                        @foreach($games as $game)
                        <th colspan=2 class="l-bord no-btm-bord">{{ $game->home_abbrv }} {{ $game->final_home }} - {{ $game->final_away }} {{ $game->_abbrv }}</th>
                        @endforeach
                        <th rowspan="2" class="l-bord no-top-bord">Tot Pts Bet</th>
                        <th rowspan="2" class="no-top-bord">Tot Pts Won</th>
                    </tr>
                    <tr>
                        <th class="no-top-bord">#</th>
                        <th  class="no-top-bord" colspan="2">Player</th>
                        @for ($i = 1; $i < 11; $i++)
                            <th class="l-bord no-top-bord">Res</th>
                            <th class="no-top-bord">Scr</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pred_array as $pred)
                    @php
                    if (($loop->index + 1) % 2 == 0) {
                        $bgd = 'even-row';
                    } else {
                        $bgd = 'odd-row';
                    }
                    @endphp
                        <tr>
                            <td rowspan="2" class="{{ $bgd }}">{{ $loop->index + 1 }}</td>
                            <td rowspan="2" class="{{ $bgd }}">{{ $pred['username'] }}</td>
                            <td class="{{ $bgd }}">Prediction</td>
                            @foreach ($games as $game)
                            <td colspan="2" class="l-bord {{ $bgd }}">{{ $pred[$game->id]['home_goals']}} - {{ $pred[$game->id]['away_goals'] }} </td>
                            @endforeach
                            <td rowspan="2" class="l-bord {{ $bgd }}">{{ $pred['tot_pts_bet'] }}</td>
                            <td rowspan="2" class="{{ $bgd }}">{{ $pred['tot_pts_won'] }}</td>
                        </tr>
                        <tr>
                            <td class="{{ $bgd }}">Pts Bet / Return</td>
                            @foreach ($games as $game)
                            @php
                            $resClass = $pred[$game->id]['res_profit'] > 0 ? 'won' : 'lost';
                            $scrClass = $pred[$game->id]['scr_profit'] > 0 ? 'won' : 'lost';
                            @endphp
                            <td class="l-bord {{ $resClass }}">{{ $pred[$game->id]['res_pts_bet'] }} / {{ $pred[$game->id]['res_profit'] }}</td>
                            <td class="{{ $scrClass }}">{{ $pred[$game->id]['scr_pts_bet'] }} / {{ $pred[$game->id]['scr_profit'] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
@endsection
