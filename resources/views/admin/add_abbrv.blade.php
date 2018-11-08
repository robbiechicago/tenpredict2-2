@extends('layouts.layout')

@section('content')

<h1 id="add-abbrv-title" data-csrf="{{ csrf_token() }}">Add Some Abbreviations</h1>

<table class="table table-striped">
@foreach($abbrvless_teams as $team)
@php
$space_team = str_replace(' ', '_', $team);    
@endphp
    <tr>
        <td width="40">{{ $team }}</td>
        <td width="10"><input type="text" id="abbrv_{{ $space_team }}" name="abbrv_{{ $space_team }}"><span id="show_abbrv_{{ $space_team }}"></span></td>
        <td width="15"><button id="{{ $space_team }}" class="save-abbrv">Save</button></td>
        <td><span id="error_{{ $space_team }}" style="color: red;"></span><div style="max-width: 35px;"><img id="tick_{{ $space_team }}" src="{!! asset('images/tick.jpg') !!}" alt="tick icon" style="width: 100%; display: none;"></div></td>
    </tr>
@endforeach
</table>


@endsection

@section('js')
<script src="{{ asset('js/add_abbrv.js') }}" defer></script>
@endsection