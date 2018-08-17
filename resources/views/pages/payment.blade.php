@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="row">
                <div class="col">

                    <h1>Payment</h1>
                    
                    <p>A couple of seasons ago, in a desperate attempt to bump up numbers, we made tPs, as it was then, free of charge.  £15, we thought, is a barrier keeping many potential players from signing up.  Of course, this meant that we'd have to stop paying out prizes, but, we reasoned, so many new people will have signed up that we'll be able to reintroduce prizes from the waves of ad revenue that would come crashing in.</p>

                    <p>Since then, numbers have continued to slowly decline, and those of us left are the ones who were more than happy to shell out fifteen quid a season and maybe win a week or two.</p>

                    <p>So, experiment failed.  Oh well.</p>

                    <p>In that case, lets bring back the prizes!  And, yes, the payment.  It's still £15 per season, and if you're the week's highest scoring player, we'll send you a tenner in the form of Amazon voucherage.</p>

                    <p>If you've not yet paid, click the button below and cough up!</p>

                    <p>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="YUQEHTXE6H2PL">
                            <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </p>

                    <p>Thanks!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
