<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>@if (trim($__env->yieldContent('title'))) @yield('title') -@endif Bart&oacute;k</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Merriweather:400,700' rel='stylesheet' type='text/css'>
    <link rel=stylesheet href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel=stylesheet href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    {{ HTML::style('css/style.css') }}
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ action('BaseController@showHome') }}"><i class="fa fa-music"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        {? $current = in_array( Route::currentRouteAction(), array( 'EventController@showList', 'EventController@showFind' ) ) ?}
        <li @if( $current ) class="active"@endif><a href="{{ action('EventController@showFind') }}">Event listings @if( $current ) <span class="sr-only">(current)</span>@endif</a></li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <label class=sr-only for=search-box>Search</label>
        <div class="input-group">
          <input id=search-box type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search" style="line-height:inherit;"></i></button>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ action('BaseController@showAbout') }}">About</a></li>
        <li><a href="{{ action('AdminController@showAdd') }}">Add your event</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<main class="container-fluid">
    @yield('content')
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>