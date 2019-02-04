<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h3 id="sd-title" data-csrf="{{ csrf_token() }}">Sudden Death - Round {{ $sd->round }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            @if (!$sd_still_in)
                You're dead!
            @else
            <div class="dropdown">
                @php
                    $dropdown_label = $current_week_sd_pick == '' ? 'Choose your weapon:' : $current_week_sd_pick;
                @endphp
                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $dropdown_label }}</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($sd_teams as $team)
                        @php
                            $sd_selected_team = $team == $current_week_sd_pick ? 'sd-selected-team' : '';
                        @endphp
                        <button class="dropdown-item sd_option" href="#" value="{{ $team }}">
                            <span class="sd-button-text {{ $sd_selected_team }}">
                                <i class="sd-icon {{ $team == $current_week_sd_pick ? 'fas fa-check' : '' }}"></i>&nbsp;&nbsp;{{ $team }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-8 sd-history">
            history goes here...  {{ $current_week_sd_pick }} 
        </div>
    </div>
</div>