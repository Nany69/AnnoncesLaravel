@extends('layouts.master')

@section('content')
<div class="body-complete">
    <h2 class="editprof">Mon compte &nbsp;<i class="fa fa-th"></i></h2>
    <a href="{{ URL::to('edit/'.Auth::user()->id) }}" style="float:right;" class="iconprof btn btn-default fa fa-wrench"> Editer mon profil</a>
    <a href="{{ URL::to('delete/'.Auth::user()->id) }}" class="iconprof2 btn btn-default fa fa-trash" onclick="return confirm('Voulez-vous vraiment supprimer votre compte ?');"> Supprimer mon compte</a>
    <div class="row">
        <div class="well article-complet">

            @foreach($user as $v)
                <div class="article-header">
                    <h1>{{ $v->username }}</h1>
                    <p>Inscrit le :&nbsp; {{ $v->created_at }}</p>
                    <hr>
                </div>
                <div class="contenu">
                    {{ $v->email }}
                </div>
                <p class="tags">tags :</p>
            @endforeach

     <div class="panel panel-default">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach($annonces as $v)
                <tr class="tr" onclick="location.href='{{ URL::to('view/'.$v->id)}}'">
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->titre }}</td>
                    <td>{{ $v->prix }} €</td>
                    <td>{{ $v->created_at }}</td>
                    <td>
                        <a class="fa fa-pencil" href="{{ URL::to('annonce/'.$v->id.'/edit') }}"></a> &nbsp;
                        <a class="fa fa-remove" href="{{ URL::to('delete/annonce/'.$v->id) }}" onclick="return confirm('Voulez vous vraiment supprimer cette annonce ?');"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        </div>
    </div>
    </div>
</div>
@stop