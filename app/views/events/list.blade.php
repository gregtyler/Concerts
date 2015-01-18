@extends('layouts.main')

@section('content')
<section class="col-sm-9">
    <h1 class="page-header hottext">
        Concerts in <a class=hottext-phrase>Bristol</a> <a class=hottext-phrase>this week</a>
    </h1>
    {{ $stream->render() }}
</section>

<section class="col-sm-3 sidebar">
    <h3><label style="font-weight:normal;">Order</label></h3>
    <div class=form-group>
        <select class=form-control>
            <option>Chronological</option>
            <option>Alphabetical</option>
        </select>
    </div>
    
    <h3>Search</h3>
    <div class=form-group>
        <label class="control-label">Date range</label>
        <select class=form-control>
            <option>Today</option>
            <option selected>This week</option>
            <option>This month</option>
            <option>Custom</option>
        </select>
    </div>
    
    <div class=form-group>
        <label class="control-label">Search term</label>
        <input type=text class=form-control />
    </div>
    
    <h3>Tag filter</h3>
    <p>Highlight events by clicking a tag.</p>
    <div style="font-size:1.2em;">
        <a class="label label-default" href="#">Opera</a> <a class="label label-default" href="#">Verdi</a>
        <a class="label label-default" href="#">Baroque</a> <a class="label label-default" href="#">Vivaldi</a>
    </div>
</section>
@stop