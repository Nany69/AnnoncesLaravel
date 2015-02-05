@extends('layouts.master')

@section('content')
<div class="well logform">
    {{ Form::open(array('route'=> ['annonce.update', $annonce->id], 'method' => 'PUT',  'files' => true, 'class'=>'form-signup')) }}
        <h2 class="form-signup-heading">Editer une annonce</h2>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {{ Form::text('titre', $annonce->titre, array('class'=>'input-block-level', 'placeholder'=>'Titre de l\'annonce')) }}
        {{ Form::text('prix', $annonce->prix, array('class'=>'input-block-level', 'placeholder'=>'Prix')) }}
        {{ Form::textarea('description', $annonce->description, array('class'=>'input-block-level', 'placeholder'=>'Description')) }}
        {{ Form::file('files[]', array('class'=>'input-block-level', 'placeholder'=>'Photo n°3', 'multiple')) }}
        @if(!empty($annonce->photo1) || !is_null($annonce->photo1))
        <div class="row photosedit">
            <img class="imgadd2 img-responsive" src="{{ URL::to('uploads/'.$annonce->id.'/'.strtolower($annonce->photo1)) }}" alt="photo"/>
            @if(!empty($annonce->photo2) || !is_null($annonce->photo2))
                <img class="imgleft2 img-responsive" src="{{ URL::to('uploads/'.$annonce->id.'/'.strtolower($annonce->photo2)) }}" alt="photo"/>
            @endif
            @if(!empty($annonce->photo3) || !is_null($annonce->photo3))
                <img class="img-right2 img-responsive" src="{{ URL::to('uploads/'.$annonce->id.'/'.strtolower($annonce->photo3)) }}" alt="photo"/>
            @endif
        </div>
        @endif


        {{ Form::submit('Enregistrer', array('class'=>'subedit btn btn-primary'))}}
    {{ Form::close() }}
    @stop
</div>