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
        <a href="https://maps.google.com/?q={{urlencode($abstract->venue->name)}},Bristol" class="event-meta-item event-meta-item-map" style="background-image:url('https://maps.googleapis.com/maps/api/staticmap?center={{urlencode($abstract->venue->name)}},Bristol&zoom=15&size=2000x1000&maptype=roadmap&markers={{urlencode($abstract->venue->name)}},Bristol');" alt="{{urlencode($abstract->venue->name)}}" />
            <strong class=event-meta-item-caption>{{$abstract->venue->name}}</strong>
        </a>
        <div class="event-meta-item event-meta-item-big" style="font-size:1em;text-align:left;">
            @if( $abstract->upcoming )
            <ul class="pull-right btn-group btn-group-tabs">
                <li class="btn btn-default"><a href="#performance-tabs-list" data-toggle="tab"><i class="fa fa-bars"></i></a>
                <li class="btn btn-default active"><a href="#performance-tabs-calendar" data-toggle="tab"><i class="fa fa-calendar"></i></a>
            </ul>
            <strong style="font-size:1.5em;">Upcoming performances</strong>
            
            <div class=tab-content>
                <div id=performance-tabs-list class="tab-pane">
                    <ul class=abstract-upcoming>
                    @foreach( $abstract->upcoming as $instance )
                    <li><a href="{{ $instance->link }}">
                        <i class="fa fa-calendar"></i> {{date('l jS M', $instance->start)}}<br>
                        <i class="fa fa-clock-o"></i> {{date('H:i A', $instance->start)}}
                    </a>
                    @endforeach
                    </ul>
                </div>
                
                <div id=performance-tabs-calendar class="tab-pane active">
                    {{ (new Calendar( $abstract->occurrences ))->render() }}
                </div>
            </div>
            
            @else
                <strong style="font-size:1.5em;">Upcoming performances</strong>
                <div class="alert alert-warning">No upcoming performances.</div>
            @endif
        </div>
    </div>
    <div class=event-description>
        {{nl2br($abstract->description)}}
    </div>
</div>
@stop