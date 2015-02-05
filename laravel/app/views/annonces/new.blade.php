@extends('layouts.master')

@section('content')
<div class="well logform">
    {{ Form::open(array('route'=>'annonce.store', 'enctype'=>'multipart/form-data', 'class'=>'form-signup')) }}
        <h2 class="form-signup-heading">Publier une annonce</h2>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        {{ Form::text('titre', null, array('class'=>'input-block-level', 'placeholder'=>'Titre de l\'annonce')) }}
        {{ Form::text('prix', null, array('class'=>'input-block-level', 'placeholder'=>'Prix')) }}
        {{ Form::select('category', array('media' => 'Multimédia', 'automoto' => 'Auto/Moto', 'service' => 'Service', 'autre' => 'Autres')) }}
        {{ Form::textarea('description', null, array('class'=>'input-block-level', 'placeholder'=>'Description')) }}
        {{ Form::file('files[]', array('class'=>'input-block-level', 'multiple')) }}

        {{ Form::submit('Publier', array('class'=>'btn btn-primary'))}}
    {{ Form::close() }}
</div>
    @stop