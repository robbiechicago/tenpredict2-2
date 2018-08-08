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

                    
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="YUQEHTXE6H2PL">
                        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
                        

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
