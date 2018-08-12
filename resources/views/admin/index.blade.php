@extends('layouts.layout')

@section('content')
<h1>Admin</h1>

<h2>Weeks</h2>

<table>
    <thead>
        <tr>
            <th>Week_num</th>
            <th>some other shite</th>
        </tr>
    </thead>
</table>

<a href="admin/calc_weekly_scores/1" class="btn btn-info">calc weekly scores</a>

<h2>Users</h2>

<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Paid</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->paid }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- <h2>Seasons</h2>

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
@endforeach --}}







@endsection