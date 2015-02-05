<?php

class Message extends Eloquent {

    protected $fillable = array('content');

    public static $rules = array(
        'content' => 'required',
        'receive_id'=>'required',
        'sender_id'=>'required',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

}