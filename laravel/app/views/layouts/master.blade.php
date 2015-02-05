<!DOCTYPE html>
<html>
<head>
<title>
    My FreeAds with Laravel
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="http://localhost/Piscine_MVC_Free_Ads/freeads/laravel/public/css/images/favicon.ico" />
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/fancybox/source/jquery.fancybox.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
<header class="nav sub-menu @if(Auth::check()) menu @else menu2 @endif">
    <nav class="container">
        <ul class="menulist list-unstyled">
            <li class="accueil"><a href="{{ URL::to('/') }}"><img class="icondrop" src="http://localhost/Piscine_MVC_Free_Ads/freeads/laravel/public/css/images/favicon.ico" alt="fav" /><b> Free--Ads</b></a></li>
            @if(Auth::check())
                <li> <i class="iconup fa fa-pencil"></i> <a href="{{ URL::to('annonce/create') }}">Nouvelle annonce</a></li>
                <li> <i class="iconup fa fa-th"></i> <a href="{{ URL::to('account') }}">Mon compte</a></li>
                <li> <i class="iconup fa fa-star"></i> <a href="#">Favoris</a></li>
                <li> <i class="iconup fa fa-envelope"></i> <a href="{{ URL::to('messages') }}">Messagerie</a></li>
            @else
                <li> <i class="iconup fa fa-pencil"></i> <a href="{{ URL::to('inscription') }}">Inscription</a></li>
                <li> <i class="iconup fa fa-sign-in"></i> <a href="{{ URL::to('login') }}">Connexion</a></li>
            @endif

        </ul>
    </nav>
        @if(Auth::check())
            <?php $url = action('UsersController@getLogout'); ?>
            <?php $pseudo = Auth::user()->username; ?>
           <div><p class="login-bouton info-user"><span style="color: #FFF;">Bienvenue <?php echo $pseudo; ?></span><a class="btn btn-default btn-sm" href="<?php echo $url; ?>">Se déconnecter <i class="fa fa-power-off"></i></a></p></div>
        @endif
    </header>

    <div id="content">
        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @elseif(Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif
        @yield('content')
    </div>

    <footer>
        <p>My FreeAds with Laravel Framework</p>
    </footer>
    {{ HTML::script('js/jquery.js') }}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/fancybox/source/jquery.fancybox.js') }}
    {{ HTML::script('js/script.js') }}
    {{ HTML::script('js/app.js') }}
</body>
</html>