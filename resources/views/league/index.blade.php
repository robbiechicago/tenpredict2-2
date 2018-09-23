@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <h1>League Table</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <td></td>
                <td>Player</td>
                <td>Res Pts Bet</td>
                <td># Correct Res</td>
                <td>Res Pts Won</td>
                <td>Scr Pts Bet</td>
                <td># Correct Scr</td>
                <td>Scr Pts Won</td>
                <td>Total Pts Won</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($totScores as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['totResPtsBet'] }}</td>
                <td>{{ $user['numRes'] }}</td>
                <td>{{ $user['resPts'] }}</td>
                <td>{{ $user['totScrPtsBet'] }}</td>
                <td>{{ $user['numScr'] }}</td>
                <td>{{ $user['scrPts'] }}</td>
                <td>{{ $user['totPoints'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection