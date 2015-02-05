<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    </head>
    <body>
    <div class="row">
            <div class="well">
            <h2>ACTIVER VOTRE COMPTE POUR POUVOIR VOUS CONNECTER</h2>
            <div>
                Cliquez sur le lien ci-dessous afin d'activer votre compte : <br>
                <a class="btn btn-default" href="{{ URL::to('inscription/confirm/'.$confirmation_code) }}">Activer mon compte</a><br>
            </div>
        </div>
    </div>
    </body>
</html>