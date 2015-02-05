<!DOCTYPE html>
<html>
<head>
<title>
    My CloudWac with Laravel
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="http://localhost/Piscine_MVC_Free_Ads/freeads/laravel/public/css/images/favicon.ico" />
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
<header class="nav sub-menu menu">
    <nav class="container">
        <ul class="menulist list-unstyled">
                <li class="unlogmenu"><a href="#"><img class="icondrop" src="http://localhost/Piscine_MVC_Free_Ads/freeads/laravel/public/css/images/favicon.ico"/><b> Free--Ads</b></a></li>
                <li>{{ HTML::link('users/register', 'Inscription') }}</li>
                <li>{{ HTML::link('users/login', 'Connexion') }}</li>
        </ul>
    </nav>
</header>

    <div id="content">
        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </div>

    <footer>
        <p> My FreeAds with Laravel Framework  {chalas_r} </p>
    </footer>
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/script.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>