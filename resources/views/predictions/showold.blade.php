@extends('layouts.layout')

@section('content')
<div class="container">
    
    <h1>Week {{ $week }}</h1>
    
    <div class="row justify-content-center">
    
        {!! Form::open(['action' => 'PredictionController@submit']) !!}
        <table id="home-weeks-table" class="table">
            <tbody>
                @foreach ($games as $game)
                @php
                    $home_goals = isset($game->predictions->first()['home_goals']) ? $game->predictions->first()['home_goals'] : NULL;
                    $away_goals = isset($game->predictions->first()['away_goals']) ? $game->predictions->first()['away_goals'] : NULL;
                    $result_points = isset($game->predictions->first()['result_points']) ? $game->predictions->first()['result_points'] : 1;
                    $score_points = isset($game->predictions->first()['score_points']) ? $game->predictions->first()['score_points'] : 1;

                    $now = date('Y-m-d H:i:s');
                    $game_active = $now > date('Y-m-d H:i:s', strtotime($game->kickoff_datetime)) ? false : true;

                    $missed_it = ($home_goals == NULL || $away_goals == NULL) && !$game_active ? true : false;
                @endphp
                <tr>
                    @if($loop->first || $game->kickoff_datetime->format('Y-m-d') != $games[$loop->index - 1]->kickoff_datetime->format('Y-m-d'))
                    <td>{{ $game->kickoff_datetime->format('D j F, Y') }}</td>
                    @else
                    <td></td>
                    @endif
                    <td>{{ $game->kickoff_datetime->format('H:i') }}</td>
                    <td>{{ $game->home_team }}</td>
                    {!! Form::hidden('game_'.$game->game_num.'[game_id]', $game->id) !!}
                    @if(!$missed_it)
                    <td>
                        @if($game_active)
                        {!! Form::selectRange('game_'.$game->game_num.'[home_goals]', 0, 15, $home_goals, ['placeholder' => '-']); !!}
                        @else
                        {{ $home_goals }}
                        @endif
                    </td>
                    <td> - </td>
                    <td>
                        @if($game_active)
                        {!! Form::selectRange('game_'.$game->game_num.'[away_goals]', 0, 15, $away_goals, ['placeholder' => '-']); !!}
                        @else
                        {{ $away_goals }}
                        @endif
                    </td>
                    @else
                    <td colspan="3"><center>Did not predict</center></td>
                    @endif
                    <td>{{ $game->away_team }}</td>
                    <td>
                        <span id="implied_result_{{ $game->game_num }}"></span>
                    </td>
                    <td>
                        @if($game_active)
                        Res: {!! Form::selectRange('game_'.$game->game_num.'[result_points]', 1, 10, $result_points, []); !!}
                        @else
                        Res: <span class="expired_res_points">{{ intval($result_points) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($game_active)
                        Scr: {!! Form::selectRange('game_'.$game->game_num.'[score_points]', 1, 10, $score_points, []); !!}
                        @else
                        Scr:  <span class="expired_scr_points">{{ $score_points }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7"></td>
                    <td>Res points: <span id="res_tot"></span></td>
                    <td>Scr points: <span id="scr_tot"></span></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                    <td colspan="2"><span id="tot_points_row" style="color: black;">Total points: <span id="tot_points"></span></span></td>
                </tr>
            </tbody>
        </table>
        
        <div class="row">
            <div class="col">
                <a href="/home" class="btn btn-link pull-right">Cancel</a>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary pull-right', 'id' => 'pred_submit']) }}
                <span id="pred_submit_disabled" style="display: none;"><button class="btn btn-outline-danger" disabled="disabled">Submit</button>&nbsp;&nbsp;Total points allocated must not exceed 50</span>
            </div>
        </div>

        {!! Form::close() !!}

        <div>
            {{ $errors }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/pred_form.js') }}" defer></script>
@endsection
