@extends('layouts.layout')

@section('content')
<h1>Admin</h1>

<h2>Seasons</h2>

@foreach ($seasons as $season)
    <h2>{{ $season->season }}</h2>
    @if($season->weeks->count() > 0))
        <ul>
        @foreach($season->weeks as $week)
            <li>{{ $week->week_num }}</li>
        @endforeach
        </ul>
    @else
        {!! Form::open(['action' => ['AdminController@create_weeks'], 'method' => 'POST']) !!}
            @csrf
            {{ Form::hidden('season_id', $season->id) }}
            {{ Form::submit('Create weeks?', ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    @endif
@endforeach







@endsection