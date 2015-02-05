@extends('layouts.master')

@section('content')
<div class="well logform">
     {{ Form::open(array('class'=>'form-signup')) }}
    <div class="form-group">
        <label class="form-control">Changer votre mot de passe</label>
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
        {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
        <br><br>
        <label class="form-control">Changer votre adresse e-mail </label>
        {{ Form::text('email', $user->email, array('class'=>'input-block-level','placeholder'=> $user->email)) }}
    </div>
    {{ Form::submit('Valider', array('class'=>'btn btn-primary'))}}
    {{ Form::close() }}
</div>
@stop