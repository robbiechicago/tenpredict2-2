@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div> --}}

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
