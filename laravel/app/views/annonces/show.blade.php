@extends('layouts.master')

@section('content')
<div class="body-complete">
    <a href="#" id="contactv" class="iconprof btn btn-default fa fa-phone"> Contacter le vendeur</a>
    <div class="row">
        <div class="well article-complet">
            @foreach($annonce as $v)
                <div class="article-header">
                    <h1>{{ $v->titre }}</h1>
                    <p> <span class="prixlabel label label-info">Prix : {{$v->prix }}€</span></p>
                    <hr>
                </div>
                <div class="contenu">
                    {{ $v->description }}
                </div>
                <div class="row photosedit">
                    @if(!empty($v->photo1) || !is_null($v->photo1))
                    <a class="fancybox fancybox.image" rel="gallery" href="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo1)) }}">
                        <img class="imgadd2 img-responsive" src="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo1)) }}" alt="photo"/>
                    </a>
                    @endif
                    @if(!empty($v->photo2) || !is_null($v->photo2))
                    <a class="fancybox fancybox.image" rel="gallery" href="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo2)) }}">
                        <img class="imgleft2 img-responsive" src="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo2)) }}" alt="photo"/>
                    </a>
                    @endif
                    @if(!empty($v->photo3) || !is_null($v->photo3))
                    <a class="fancybox fancybox.image" rel="gallery" href="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo3)) }}">
                        <img class="img-right2 img-responsive" src="{{ URL::to('uploads/'.$v->id.'/'.strtolower($v->photo3)) }}" alt="photo"/>
                    </a>
                    @endif
                </div>
                <p class="tags">Publié le :&nbsp; {{ $v->created_at }}</p>
            </div>
            <div class="commentaires">
                <div id="ajout-commentaire">
                    {{ Form::open(array('route'=> ['messages.store'], 'method' => 'POST', 'class'=>'form-signup')) }}
                    {{ Form::hidden('sendername', Auth::user()->username) }}
                    {{ Form::hidden('sender_id', Auth::user()->id) }}
                    {{ Form::hidden('receive_id', $v->user_id) }}
                    {{ Form::textarea('content',null, array('class'=>'input-block-level', 'placeholder'=>'Contenu du message')) }}
                    {{ Form::submit('Enregistrer', array('class'=>'subedit btn btn-primary'))}}
                    {{ Form::close() }}
                </div>
                @endforeach
            </div>
    </div>
</div>
@stop