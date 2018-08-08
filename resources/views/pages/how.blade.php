@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="jumbotron">
                <div class="container">
                    <center><img src="{{ asset('images/ball-name-logo.png') }}" alt="TenPredict Logo"></center>
                </div>
            </div>

            <div class="row">
                <div class="col">

                    <h1>How to play</h1>
                    
                    <p>
                        Football predictions at tenpredict are easy:
                    </p>
                    <br /><br />
                    <h3>In a nutshell:</h3>
                    
                    <p>
                        Ten games → A score and result prediction on each → 50 points to bet across your predictions, from 1 to a maximum of 10 on each one → A correct result gives you a profit of 2x your bet → A correct score, you get 5x your bet → That's it!            
                    </p>
                    <br /><br />
                    <h3>A bit more detail:</h3>

                    {{-- <p>The weekly predictions page looks a bit like this:</p>
                    <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <img src="{{ asset('images/how-empty-form.png') }}" alt="TenPredict Logo" style="max-width: 100%;">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <br /><br />
                    <p>
                        Clicking on a Predict Now button brings up the prediction form for that game:
                    </p>
                    <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <img src="{{ asset('images/how-empty-game.png') }}" alt="TenPredict Logo" style="max-width: 100%;">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <br /><br />
                    <p>
                        Let's say you think Spurs will win 3-1, and you want to bet 4 points on the result being an away win, and 2 points on the score being 1-3.  Just click or tap on the corresponding buttons (scrolling down for larger numbers) so that the form looks like this:
                    </p>
                    <br /><br />
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <img src="{{ asset('images/how-full-game.png') }}" alt="TenPredict Logo" style="max-width: 100%;">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <br /><br /> --}}
                    <p>
                        Each weekend we'll predict on ten games. We pick Premier League games if there are any, and work our way down the leagues when there aren't. Sometimes we'll get internationals, sometimes FA Cup games. But, unless we're having our Christmas break, during the Premier League season there will always be ten games each weekend to predict.
                    </p>
                    <p>
                        You predict the score. This implies a result (home win, away win, draw).
                    </p>
                    <p>
                        Unlike other prediction games where you might get 3 points for a correct score and a point for a correct result, at tenpredict we place points on our predictions. Each weekend we have fifty to play with.
                    </p>
                    <p>
                        Ten games = ten score predictions + ten result predictions. Twenty predictions in all, and each must have between 1 and 10 points placed upon them.
                    </p>
                    <p>
                        When you get a result right, you'll be rewarded with a profit of 2x your stake, plus you'll get your stake back. A correct result gets you 5x.
                    </p>
                    <p>
                        You can tweak your predictions right up to a minute before kick-off time.  So if some vital injury news comes in on Sunday afternoon you can change your mind accordingly.
                    </p>
                    <p>
                        That's really all there is to it. It's up to you whether you spread your points around or zone in on two or three games. Will you play it safe and focus on result bets or go for broke on scores. The possibilities are endless!
                    </p>
                    <p>
                        <em>Good luck!</em>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
