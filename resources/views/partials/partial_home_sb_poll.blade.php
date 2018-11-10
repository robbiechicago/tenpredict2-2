<div class="col-md-12 poll-container">
    <div class="poll-inner-div">
        <h3 id="poll-title" data-csrf="{{ csrf_token() }}">Poll</h3>
        <h6><em>{{ $poll->title }}</em></h6>

        <hr>
        
        @php
        $voted = false;
        $my_vote = '';   
        $tot_votes = 0;
        
        foreach ($poll->answers as $ans) {
            $tot_votes += count($ans->votes);
            if (count($ans->votes) > 0) {
                foreach ($ans->votes as $vote) {
                    if ($vote->user_id == Auth::id()) {
                        $voted = true;
                        $my_vote = $ans->answer;
                    }
                }
            }
        }
        @endphp

        @foreach ($poll->answers as $answer)

            @php
                if (count($answer->votes) == 0) {
                    $vote_percent = 0;
                } else {
                    $vote_percent = round((count($answer->votes) / $tot_votes) * 100);
                }
            @endphp
            
            @if ($loop->index == 0 || $loop->index % 2 == 0)
                <div class="row"> 
            @endif

                <div class="col-xl-6">
                    @if ($voted)
                        <div>
                            {{ $answer->answer }}
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{ $vote_percent }}%" aria-valuenow="{{ $vote_percent }}" aria-valuemin="0" aria-valuemax="100">{{ count($answer->votes) > 0 ? $vote_percent . '%' : '' }}</div>
                        </div>
                    @else
                    <label>{{ Form::radio('poll_' . $poll->id, $answer->id, '', ['class' => 'poll-radio']) }}&nbsp;{{ $answer->answer }}</label>
                    @endif
                </div>

            @if ($loop->index % 2 != 0 || $loop->last)
                </div>
            @endif

        @endforeach
        
        <hr>
        @if ($voted)
            <span><em>Total votes: {{ $tot_votes }}. You voted for "{{ $my_vote }}".</em></span>
        @else
        <button class="btn btn-outline-dark float-right poll-submit-disabled" style="display: block;" disabled>Select an option...</button>
        <button class="btn btn-warning border-dark float-right poll-submit" style="display: none;">Vote!</button>
        @endif
        <div style="clear: both;"></div>
    </div>
</div> 