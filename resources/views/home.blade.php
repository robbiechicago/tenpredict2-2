@extends('layouts.layout')

@section('content')
<div class="container-fluid">

    <div id="home-container" class="justify-content-center">
        
        <div class="row">
            <div class="col-xs-12">
                <h1>Welcome back, {{ Auth::user()->name }}!</h1>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-8">
                <div class="row data-box-container d-none d-sm-flex">
                    @include('partials.partial_home_data_boxes')
                </div>

                @if ($poll)
                    <div class="row d-sm-none">
                        @include('partials.partial_home_sb_poll')
                    </div>
                @endif

                <div class="row">
                    @include('partials.partial_home_main_pred_table')
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div id="home-sidebar" class="col-sm-4">

                @if ($poll)
                    <div class="row d-none d-sm-flex">
                        @include('partials.partial_home_sb_poll')
                    </div>
                @endif

                <div class="row">
                    @include('partials.partial_home_sb_league_table')
                </div>

                <div class="row">
                    @include('partials.partial_home_sb_week_table')
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/poll.js') }}" defer></script>
@endsection