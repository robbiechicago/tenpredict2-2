<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h3 id="sd-title" data-csrf="{{ csrf_token() }}">Sudden Death</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="dropdown">
                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose your weapon:</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($sd_teams as $team)
                        <a class="dropdown-item sd_option" href="#" value="{{ $team }}">{{ $team }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-8 sd-history">
            history goes here...
        </div>
    </div>
</div>