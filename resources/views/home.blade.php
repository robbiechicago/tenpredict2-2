@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TenPredict News</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Welcome back to TenPredict for the 2018/19 season!</h3>

                    <p>
                        You'll notice the site is rather different (again).  You'll have to bear with us for a few weeks as things are still rather bare, and no doubt it'll all change in front of your eyes for a while, but this new site has the potential to be much better than the last.
                    </p>
                    <p>
                        In the pipeline we'll be bringing back features that were missing from last season such as InPlay and Mini Leagues, and hopefully lots of other cool stuff too.
                    </p>
                    <p>
                        You'll notice two big differences this season:  
                    </p>
                    <p>
                        Firstly, the prediction form is completely restructured.  Instead of filling in all ten games and submitting, you now do them one at a time in a pop-up that is considerably more mobile-friendly.
                    </p>
                    <p>
                        Secondly, back by fairly popular demand: Prizes!  Yes, we're going back to awarding £10 to each weekly winner!  Of course, we'll need some dough off you to cover this, so we have reintroduced the £15 fee to join.  Sorry about that.  But we think it's exceptional value for the Web's Best Football Game!
                    </p>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="YUQEHTXE6H2PL">
                        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
                    <p>Please pay using the PayPal button above.  You can still predict if you've not paid, but you'll not be eligible for the weekly prize unless we've recieved your fee before the first fixture of the weekend has kicked off.  And eventually we'll deactivate your account - TenPredict is a pay to play game!</p>

                </div>
            </div>
        </div>

        <table id="home-weeks-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Week</th>
                    <th scope="col">My Predictions</th>
                    <th scope="col">My Weekly Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeks as $week)
                    <tr>
                        <td>{{ $week->play_week_num }}</td>
                    <td><a href="season/{{ $week->season->season }}/week/{{ $week->play_week_num }}/predictions">Predict now!</a></td>
                        <td>&nbsp;</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
