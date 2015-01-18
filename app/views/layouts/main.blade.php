<!doctype html>
<html>
<head>
    <title>Concerts</title>
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
      <a class="navbar-brand" href="#"><i class="fa fa-music"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li @if( Route::currentRouteAction() === 'EventController@showList' ) class="active"@endif><a href="{{ action('EventController@showList') }}">This week <span class="sr-only">(current)</span></a></li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">About</a></li>
        <li><a href="#">Add your event</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<main class="container-fluid">
    @yield('content')
</main>
</body>
</html>