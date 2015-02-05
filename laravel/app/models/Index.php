<?php

class Index extends Eloquent {

    protected $fillable = array('titre', 'description', 'photo1', 'photo2', 'photo3', 'prix');

    public static $rules = array(
        'titre' => 'required',
        'description'=>'required',
        'prix'=>'required|integer',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'annonces';

}