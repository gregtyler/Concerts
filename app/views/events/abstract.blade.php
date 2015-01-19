@extends('layouts.main')

@section('title', $abstract->title)

@section('content')
<div class=container>
    <h1 class=page-header>{{ $abstract->title }}</h1>
    
    <div>
        @foreach( $abstract->tags as $tag )
        <a href="{{ $tag->link }}" class="label label-default">{{ $tag->label }}</a>
        @endforeach
    </div>
    
    <div class=event-meta>
        <h3>Upcoming performances</h3>
        @if( $abstract->upcoming )
            <ul class=abstract-upcoming>
            @foreach( $abstract->upcoming as $instance )
            <li><a href="{{ $instance->link }}">
                <div class=pull-right>{{$instance->venue->name}}, {{$instance->venue->area->label}}</div>
                <i class="fa fa-calendar"></i> {{date('l jS M', $instance->start)}}<br>
                <i class="fa fa-clock-o"></i> {{date('H:i A', $instance->start)}}
            </a>
            @endforeach
            </ul>
        @else
            <div class="alert alert-warning">No upcoming performances.</div>
        @endif
    </div>
    <div class=event-description>
        {{nl2br($abstract->description)}}
    </div>
</div>
@stop