@extends('layouts.main')

@section('content')
<div class=container>
    <h1 class=page-header>{{$venue->name}}</h1>
    <div class=col-sm-4 style="margin-bottom:1em;">
        <a style="display:block;width:100%;height:300px;background-position:center;background-image:url('https://maps.googleapis.com/maps/api/staticmap?center={{urlencode($venue->name)}},Bristol&zoom=15&size=2000x1000&maptype=roadmap&markers={{urlencode($venue->name)}},Bristol');" alt="St George's" /></a>
    </div>
    <div class=col-sm-8>
        <h2 class=stream-heading>Upcoming events</h2>
        {{ $stream->render() }}
    </div>    
</div>
@stop