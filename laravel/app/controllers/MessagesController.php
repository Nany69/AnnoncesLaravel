<?php

class MessagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userid = Auth::user()->id;
        $envoyes = Message::where('sender_id', '=', $userid)->paginate(3);
        $recus = Message::where('receive_id', '=', $userid)->orderBy('id', 'desc')->paginate(3);
        Return View::make('messages.mailbox')->with('envoyes', $envoyes)->with('recus', $recus);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    	Return View::make('annonces.show');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		    $msg = new Message;
            $msg->sendername = Input::get('sendername');
            $msg->sender_id = Input::get('sender_id');
            $msg->receive_id = Input::get('receive_id');
            $user = User::where('id', '=' , Input::get('receive_id'))->get();
            foreach($user as $v){
            	$recname = $v->username;
            }
            $msg->receivername = $recname;
            $msg->content = Input::get('content');
			$msg->save();
		    return Redirect::to('/')->with('message', 'Votre message a bien été envoyé !');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
