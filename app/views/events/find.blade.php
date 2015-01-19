@extends('layouts.main')

@section('title', 'Find events')

@section('content')
<div class=container>
    {{ Form::open(array('action' => 'EventController@doFind')) }}
    <h1 class=page-header>Find events</h1>
    <div class="form-group form-group-lg">
        <label for=f_area>Select a location from the list below:</label>
        <select class=form-control name=area id=f_area>
            @foreach( $areas as $area )
            <option>{{ $area->label }}</option>
            @endforeach
        </select>
    </div>
    <div class=text-center>
        <input type=submit class="btn btn-lg btn-primary" value="Find events" />
    </div>
    {{ Form::close() }}
</div>
@stop