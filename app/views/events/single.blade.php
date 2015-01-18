@extends('layouts.main')

@section('title', $occurrence->event->title)

@section('content')
<div class=container>
    <h1 class=page-header>{{$occurrence->event->title}}</h1>
    @if( $occurrence->end < time() )
    <div class="alert alert-danger" role=alert>
        <p><strong><i class="fa fa-clock-o"></i> Historic event</strong></p>
        <p>This event has already happened. We maintain this page as an archive.</p>
    </div>
    @elseif( $occurrence->start < time() )
    <div class="alert alert-warning" role=alert>
        <p><strong><i class="fa fa-clock-o"></i> Ongoing event</strong></p>
        <p>This event is happening right now!</p>
    </div>
    @endif
    <div class=event-meta>
        <a href="https://maps.google.com/?q={{urlencode($occurrence->venue->name)}},Bristol" class="event-meta-item event-meta-item-map" style="background-image:url('https://maps.googleapis.com/maps/api/staticmap?center={{urlencode($occurrence->venue->name)}},Bristol&zoom=15&size=2000x1000&maptype=roadmap&markers={{urlencode($occurrence->venue->name)}},Bristol');" alt="St George's" />
            <strong class=event-meta-item-caption>{{$occurrence->venue->name}}</strong>
        </a>
        <div class=event-meta-item style="">
            <strong style="font-size:1.5em;">{{date('jS M', $occurrence->start)}}</strong>
            <br>
            {{date('l', $occurrence->start)}}
        </div>
        <div class=event-meta-item>
            <strong style="font-size:1.5em;">{{date('H:i A', $occurrence->start)}}</strong>
            <br>
            @if( $occurrence->end - $occurrence->start > 3600*24 )
            <strong>{{floor( ( $occurrence->end - $occurrence->start ) / (3600*24) )}}</strong>d
            <strong>{{floor( ( $occurrence->end - $occurrence->start ) % (3600*24) / (3600*24) )}}</strong>h
            @else
            <strong>{{floor( ( $occurrence->end - $occurrence->start ) / 3600 )}}</strong>h
            <strong>{{str_pad( floor((( $occurrence->end - $occurrence->start ) % 3600)/60), 2, '0', STR_PAD_LEFT)}}</strong>m
            @endif
        </div>
        {? $upcoming = count( $occurrence->upcoming ) ?}
        @if( $upcoming )
        <div class="event-meta-item event-meta-item-big">
            <a href=#>{{ Lang::choice('events.upcoming_performance_notice', $upcoming ) }}</a>
        </div>
        @endif
    </div>
    <div class=event-description>
        {{nl2br($occurrence->event->description)}}
    </div>    
</div>
<div class=container>
    <h3>More like this</h3>
    <ul>
        @forelse( $occurrence->event->similar as $ev )
            <li>{{$ev->title}}
        @empty
            <li>No similar events found.
        @endforelse
    </ul>
</div>
@stop