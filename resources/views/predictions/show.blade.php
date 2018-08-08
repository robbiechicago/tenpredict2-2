@extends('layouts.layout')

@section('content')
<div class="container">
    
    <h1>Week {{ $week }}</h1>
    

    @foreach ($games as $game)
        @php
            $now = date('Y-m-d H:i:s');
            $game_started = strtotime($game->kickoff_datetime) < strtotime($now);
            $prediction_submitted = count($game->predictions) > 0;
            $odd_even = $loop->index % 2 == 0 ? 'even_row' : 'odd_row';
        @endphp
        @if($loop->first || $game->kickoff_datetime->format('Y-m-d') != $games[$loop->index - 1]->kickoff_datetime->format('Y-m-d'))
        <div class="row date-row">
            <div class="col-lg-4">
                <h3>{{ $game->kickoff_datetime->format('D j F, Y') }}</h3>
            </div>
            @if($loop->first)
            <div class="col-lg-3">
                Total Result points: <span id="page-tot-res-pts"></span>
            </div>
            <div class="col-lg-3">
                Total Score points: <span id="page-tot-scr-pts"></span>
            </div>
            <div class="col-lg-2">
                Total points: <span id="page-tot-pts"></span>
            </div>
            @endif
        </div>
        <hr>
        <div class="row">
        @endif
            <div class="col-12">
                <div class="row {{ $odd_even }} pred-row">
                    <div class="col-xs-12 col-lg-1 offset-lg-1">
                    @if($loop->first || $game->kickoff_datetime->format('H:i') != $games[$loop->index - 1]->kickoff_datetime->format('H:i'))
                        <h4>{{ $game->kickoff_datetime->format('H:i') }}:&nbsp;&nbsp;</h4>
                    @endif
                    </div>
                    <div class="col-lg-10 col-xs-9 pred-box">
                        <div class="row">
                            
                            {{-- FIXTURE --}}
                            <div class="col-12 col-lg-5">
                                @if($prediction_submitted)
                                <h5> {{ $game->home_team }} {{ $game->predictions[0]->home_goals }} - {{ $game->predictions[0]->away_goals }} {{ $game->away_team }}</h5>
                                @else
                                <h5> {{ $game->home_team }} vs {{ $game->away_team }}</h5>
                                @endif
                            </div>

                            {{-- POINTS --}}
                            <div class="col-3 col-lg-2">
                                @if($prediction_submitted)
                                Res:&nbsp;&nbsp;<span class="page-game-res-pts">{{ $game->predictions[0]->result_points }}</span>
                                @else
                                Res:&nbsp;&nbsp;<span class="page-game-res-pts">1</span>
                                @endif
                            </div>
                            <div class="col-3 col-lg-2">
                                @if($prediction_submitted)
                                Scr:&nbsp;&nbsp;<span class="page-game-scr-pts">{{ $game->predictions[0]->score_points }}</span>
                                @else
                                Scr:&nbsp;&nbsp;<span class="page-game-scr-pts">1</span>
                                @endif
                            </div>

                            {{-- BUTTONS --}}
                            <div class="col-6 col-lg-3">
                                @if(!$game_started)
                                    @if($prediction_submitted)
                                    <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#pred_form" data-gameid="{{ $game->id }}">Edit Prediction</button>
                                    @else
                                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#pred_form" data-gameid="{{ $game->id }}">Predict Now</button>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @if($loop->last || $game->kickoff_datetime->format('Y-m-d') != $games[$loop->index + 1]->kickoff_datetime->format('Y-m-d'))
        </div>
        @endif

        @endforeach    
        
</div>

<!-- Modal -->
<div class="modal" id="pred_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pred-form-title" data-csrf="{{ csrf_token() }}"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <hr>
                <div id="pred-form-title-points">
                    <h6>Result Points: <span id="pred-form-title-points-res"></span></h6>
                    <h6>Score Points: <span id="pred-form-title-points-scr"></span></h6>
                    <h6>Total Points (all games): <span id="pred-form-title-points-all" value=""></span></h6>
                </div>
            </div>

            <div id="fake-head-row" class="modal-body row">
                <div class="col-3 w-25 fake-table-head">Home Goals</div>
                <div class="col-3 w-25 fake-table-head">Away Goals</div>
                <div class="col-3 w-25 fake-table-head">Result Points</div>
                <div class="col-3 w-25 fake-table-head">Score Points</div>
            </div>
            <div id="modal-bodee" class="modal-body">
                <div id="pred-form-table-div" class="row">
                    <div class="col">
                        <table id="pred-form-table" class="table table-sm table-bordered">
                            <tbody>
                                @for ($x = 0; $x < 16; $x++)
                                    <tr>
                                        <td class="w-25 pred-form-num home-num" data-value="{{ $x }}"><span id="home-goals-{{ $x }}">{{ $x }}</span></td>
                                        <td class="w-25 pred-form-num away-num" data-value="{{ $x }}"><span id="away-goals-{{ $x }}">{{ $x }}</span></td>
                                        @if($x == 0)
                                        <td class="w-25 pred-form-num result-num" data-value="10"><span id="result-points-0">10</span></td>
                                        <td class="w-25 pred-form-num score-num" data-value="10"><span id="score-points-0">10</span></td>
                                        @elseif($x > 0 && $x < 11)
                                        <td class="w-25 pred-form-num result-num" data-value="{{ $x }}"><span id="result-points-{{ $x }}">{{ $x }}</span></td>
                                        <td class="w-25 pred-form-num score-num" data-value="{{ $x }}"><span id="score-points-{{ $x }}">{{ $x }}</span></td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        @endif
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="pred-form-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="pred-form-submit-disabled" class="btn btn-outline-default" disabled>Save prediction</button>
                <button type="button" id="pred-form-submit" class="btn btn-primary" style="display: none;">Save prediction</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="{{ asset('js/pred_form.js') }}" defer></script>
@endsection
