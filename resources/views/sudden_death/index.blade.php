@extends('layouts.layout')

@section('content')
<div class="container">

    <h1>Sudden Death</h1>

    @foreach ($sd_array as $sd)
        <table class="table table-nonfluid">
            <thead>
                <tr>
                    <th>Player</th>
                    @for ($i = $sd['min_week']; $i <= $sd['max_week']; $i++)
                        <th>Week {{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($sd['players'] as $player)
                    <tr>
                        <td>{{ $player }}</td>
                        @for ($i = $sd['min_week']; $i <= $sd['max_week']; $i++)
                            @foreach ($sd['sd']->picksByUserWeek as $pick)
                                @if ($pick->week_id == $i && $pick->user->name == $player)
                                    <td>{{ $pick->team_picked }}</td>
                                @endif
                            @endforeach
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
    
</div>
@endsection
