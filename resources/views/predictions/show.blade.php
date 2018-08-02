@extends('layouts.layout')

@section('content')
<div class="container">
    
    <h1>Week {{ $week }}</h1>
    

    @foreach ($games as $game)
        @php
            $now = date('Y-m-d H:i:s');
        @endphp
        @if($loop->first || $game->kickoff_datetime->format('Y-m-d') != $games[$loop->index - 1]->kickoff_datetime->format('Y-m-d'))
        <div class="row">
            <div class="col">
                <h3>{{ $game->kickoff_datetime->format('D j F, Y') }}</h3>
            </div>
        </div>
        <div class="row">
        @endif
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">{{ $game->home_team }} vs {{ $game->away_team }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $game->kickoff_datetime->format('H:i') }}</h5>
                        <p class="card-text"></p>
                        {{-- @if(strtotime($game->kickoff_datetime) > strtotime($now)) --}}
                            @if(count($game->predictions) > 0)
                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#pred_form" data-gameid="{{ $game->id }}">Edit Prediction</button>
                            @else
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#pred_form" data-gameid="{{ $game->id }}">Predict Now</button>
                            @endif    
                        {{-- @endif --}}
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
                    <h6>Total Points (all predictions): <span id="pred-form-title-points-all"></span></h6>
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
                                        @if($x > 0 && $x < 11)
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
                <button type="button" id="pred-form-cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="pred-form-submit" class="btn btn-primary" >Save changes</button>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="{{ asset('js/pred_form.js') }}" defer></script>
@endsection
