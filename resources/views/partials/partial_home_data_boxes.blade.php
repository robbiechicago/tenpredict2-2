{{-- SHOW ON LARGER SCREENS --}}
<div class="col-lg-3 d-none d-lg-block">
    <div class="home-data-box home-data-box-top-row">
        <div class="home-data-box-heading">Total Points</div>
        <div class="home-data-box-data">{{ $my_tot_points }}</div>
    </div>
</div>
<div class="col-lg-3 d-none d-lg-block">
    <div class="home-data-box home-data-box-top-row">
        <div class="home-data-box-heading">League Position</div>
        <div class="home-data-box-data">{{ $my_league_pos }}</div>
    </div>
</div>

<div class="col-lg-3 d-none d-lg-block">
    <div class="home-data-box">
        <div class="home-data-box-heading">Highest Score</div>
        <div class="home-data-box-data">{{ $high_score }} (week{{ $hs_best_week_s }} {{ $hs_best_weeks_string }})</div>
    </div>
</div>
<div class="col-lg-3 d-none d-lg-block">
    <div class="home-data-box">
        <div class="home-data-box-heading">Best Weekly Place</div>
        <div class="home-data-box-data">{{ $best_rank }} (week{{ $best_week_s }} {{ $best_weeks_string }})</div>
    </div>
</div>

{{-- SHOW ON SMALLER SCREENS --}}
<div class="col-lg-12">
    <div class="row d-lg-none home-data-box-top-row">
        <div class="col-sm-6">
            <div class="home-data-box">
                <div class="home-data-box-heading">Total Points</div>
                <div class="home-data-box-data">{{ $my_tot_points }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="home-data-box">
                <div class="home-data-box-heading">League Position</div>
                <div class="home-data-box-data">{{ $my_league_pos }}</div>
            </div>
        </div>
    </div>

    <div class="row d-lg-none">
        <div class="col-sm-6">
            <div class="home-data-box">
                <div class="home-data-box-heading">Highest Score</div>
                <div class="home-data-box-data">{{ $high_score }} (week{{ $hs_best_week_s }} {{ $hs_best_weeks_string }})</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="home-data-box">
                <div class="home-data-box-heading">Best Weekly Place</div>
                <div class="home-data-box-data">{{ $best_rank }} (week{{ $best_week_s }} {{ $best_weeks_string }})</div>
            </div>
        </div>
    </div>
</div>
