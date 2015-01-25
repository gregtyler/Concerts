<ul class=stream-list>
    @forelse($stream as $occurrence)
    <li class="stream-item{{ $occurrence->first_of_event ? '' : ' stream-item-small' }}">
        <a href="{{$occurrence->link}}" class=stream-image @if( $occurrence->event->image ) style="background-image:url({{$occurrence->event->image}})" @endif></a>
        <div class=stream-body>
            <h3 class=stream-title><a href="{{$occurrence->link}}">{{$occurrence->event->title}}</a></h3>
            <ul class=stream-meta>
                <li><i class="fa fa-calendar"></i> {{date('l jS', $occurrence->start)}}
                <li><i class="fa fa-clock-o"></i> {{date('H:i A', $occurrence->start)}}
                <li><i class="fa fa-map-marker"></i> <a href="{{$occurrence->event->venue->link}}">{{$occurrence->event->venue->name}}</a>, {{$occurrence->event->venue->area->label}}
            </ul>
            <p class=stream-desc>{{nl2br($occurrence->event->stinger)}}</p>
            <ul class=stream-tags>
                @foreach($occurrence->event->tags as $tag)
                <li><a class="label label-default" href="{{ $tag->link }}">{{$tag->label}}</a>
                @endforeach
            </ul>
        </div>
    @empty
    <li><div class="alert alert-warning">No results found.</div>
    @endforelse
</ul>