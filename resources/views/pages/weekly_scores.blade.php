@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h1>Week {{ $week_num }} Scores</h1>

            <table id="weekly-scores-table" class="table">
                <thead>
                    <tr>
                        <th colspan="3" class="no-btm-bord head-1"></th>
                        @foreach($games as $game)
                        <th colspan=2 class="l-bord no-btm-bord head-1">{{ $game->home_abbrv }} {{ $game->postponed == 0 ? $game->final_home : 'P' }}<br />{{ $game->away_abbrv }} {{ $game->postponed == 0 ? $game->final_away : 'P' }}</th>
                        @endforeach
                        <th colspan="2" class="l-bord no-btm-bord head-1"># correct</th>
                        <th colspan="2" class="l-bord no-btm-bord head-1">Pts won</th>
                        <th colspan="2" class="l-bord no-btm-bord head-1">Tot pts</th>
                    </tr>
                    <tr>
                        <th class="no-top-bord head-2" colspan="3"></th>
                        @for ($i = 1; $i < 13; $i++)
                            <th class="l-bord no-top-bord head-2">Res</th>
                            <th class="no-top-bord head-2">Scr</th>
                        @endfor
                        <th class="l-bord no-top-bord head-2">Bet</th>
                        <th class="no-top-bord head-2">Won</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pred_array as $pred)
                    @php
                    // echo '<pre>';
                    // print_r($pred);
                    // echo '</pre>';
                    // die();
                    if (($loop->index + 1) % 2 == 0) {
                        $bgd = 'even-row';
                    } else {
                        $bgd = 'odd-row';
                    }
                    @endphp
                        <tr>
                            <td rowspan="2" class="{{ $bgd }}">{{ $loop->index + 1 }}</td>
                            <td rowspan="2" class="{{ $bgd }}">{{ $pred['username'] }}</td>
                            <td class="{{ $bgd }}">Pred</td>
                            @foreach ($games as $game)
                            <td colspan="2" class="l-bord {{ $bgd }}">{{ $pred[$game->id]['home_goals']}} - {{ $pred[$game->id]['away_goals'] }} </td>
                            @endforeach
                            <td rowspan="2" class="l-bord bgd-1">{{ $pred['num_correct_res'] }}</td>
                            <td rowspan="2" class="bgd-1">{{ $pred['num_correct_scr'] }}</td>
                            <td rowspan="2" class="l-bord bgd-2">{{ $pred['pts_won_res'] }}</td>
                            <td rowspan="2" class="bgd-2">{{ $pred['pts_won_scr'] }}</td>
                            <td rowspan="2" class="l-bord bgd-3">{{ $pred['tot_pts_bet'] }}</td>
                            <td rowspan="2" class="bgd-3">{{ $pred['tot_pts_won'] }}</td>
                        </tr>
                        <tr>
                            <td class="{{ $bgd }}">Pts</td>
                            @foreach ($games as $game)
                            @php
                            $resClass = $game->postponed == 0 ? ($pred[$game->id]['res_profit'] > 0 ? 'won' : 'lost') : 'postponed';
                            $scrClass = $game->postponed == 0 ? ($pred[$game->id]['scr_profit'] > 0 ? 'won' : 'lost') : 'postponed';
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
