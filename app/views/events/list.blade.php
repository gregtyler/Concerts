@extends('layouts.main')

@section('title','Concerts in ' . $area->label . ' ' . $timeframe->label)

@section('content')
<section class="col-sm-9">
    <h1 class="page-header hottext">
        Concerts in <a class=hottext-phrase>{{ $area->label }}</a> <a class=hottext-phrase>{{ $timeframe->label }}</a>
    </h1>
    {{ $stream->render() }}
</section>

<section class="col-sm-3 sidebar">
    {{ Form::open(array('action' => 'EventController@doFind')) }}
    <input type=hidden name=area value="{{ $area->label }}" />
    
    <h3><label for=f_sort style="font-weight:normal;">Order</label></h3>
    <div class=form-group>
        <select class=form-control name=sort id=f_sort>
            <option value=chrono{{ Input::get('sort') === 'chrono' ? ' selected' : '' }}>Chronological</option>
            <option value=alpha{{ Input::get('sort') === 'alpha' ? ' selected' : '' }}>Alphabetical</option>
        </select>
    </div>
    
    <h3>Search</h3>
    <div class=form-group>
        <label for=f_timeframe class=control-label>Date range</label>
        <select class=form-control name=timeframe id=f_timeframe>
            @foreach( $timeframe->frames as $frame )
            <option value="{{ $frame }}"{{ $frame === $timeframe->code ? ' selected' : '' }}>{{ ucfirst( str_replace( '_', ' ', $frame ) ) }}</option>
            @endforeach
        </select>
    </div>
    
    <div class=form-group>
        <label class=control-label for=f_q>Search term</label>
        <input type=search class=form-control id=f_q name=q value="{{ Input::get('q') }}" />
    </div>
    
    <div class=form-group>
        <input type=submit class="btn btn-lg btn-primary" value="Update results" />
    </div>
    
    <h3>Tag filter</h3>
    <div class=form-group>
        <p>Highlight events by clicking a tag.</p>
        <div style="font-size:1.2em;">
            @foreach( $tags as $tag )
            <a class="label label-default" href="{{ $tag->link }}">{{ $tag->label }}</a>
            @endforeach
        </div>
    </div>
    {{ Form::close() }}
</section>
@stop