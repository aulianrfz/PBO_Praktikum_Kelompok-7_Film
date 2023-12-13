<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
        type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link  href="{{ url('style.css') }}" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="app-layout">
    <nav class="navbar navbar-default" style="background-color: #265172 ">
        <div class="container">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse" style="background-color: #ffffff">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}" style="color: #ffffff">Cravitae</a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}"style="color: #ffffff">Home</a></li>
                    <li><a href="{{ url('about') }}"style="color: #ffffff">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" style="color: #ffffff">Login</a></li>
                        <li><a href="{{ url('/register') }}" style="color: #ffffff">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false" style="color: #ffffff">
                                {{ Auth::user()->name }} <span class="caret" style="color: #ffffff" ></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" >
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out" ></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>
