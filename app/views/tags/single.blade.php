@extends('layouts.main')

@section('title', 'Tagged: ' . $tag->label)

@section('content')
<div class=container>
    <h1 class=page-header>Events tagged "{{$tag->label}}"</h1>
    <div class=col-sm-12>
        {{ $stream->render() }}
    </div>    
</div>
@stop