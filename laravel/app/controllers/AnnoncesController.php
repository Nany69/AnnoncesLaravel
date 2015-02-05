<?php

class AnnoncesController extends \BaseController {

	public function __construct(){
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth');
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function create(){
		 if(!Auth::check()) return Redirect::to('users/login')->with('error', 'Vous ne pouvez pas créer une annonce sans être inscrit');
	    	Return View::make('annonces.new');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(){
		$validator = Validator::make(Input::all(), Annonce::$rules);
		if($validator->passes()){
		    $add = new Annonce;
            $add->titre = Input::get('titre');
            $add->description = Input::get('description');
            $add->prix = Input::get('prix');
            $add->user_id = Auth::user()->id;
            $add->category = Input::get('category');
            $files = Input::file('files');

            if(isset($files[0]) && !empty($files[0]))
            	$add->photo1 = $files[0]->getClientOriginalName();
            if(isset($files[1]) && !empty($files[1]))
            	$add->photo2 = $files[1]->getClientOriginalName();
            if(isset($files[2]) && !empty($files[2]))
            	$add->photo3 = $files[2]->getClientOriginalName();

			$add->save();

			if(!empty($add->photo1)){
				foreach ($files as $file) {
					$path = public_path(strtolower('uploads'.DIRECTORY_SEPARATOR.$add->id));
					$filename = strtolower($file->getClientOriginalName());
					$extension = strtolower($file->getClientOriginalExtension());
					$mime = $file->getMimeType();
					$file->move($path, $filename);
			    }
			}
		    return Redirect::to('/')->with('message', 'Votre annonce est désormais en ligne !');
		}else{
		    return Redirect::to('annonce/create')->with('error', 'Veuillez corriger les erreurs suivantes')->withErrors($validator)->withInput();
		}
	}

	/**
	 * Display the specified re source.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getView($id){
		$annonce  = Annonce::where('id', '=', $id)->get();
		// $user  = User::where('id', '=', $annonce->id)->get();
        return View::make('annonces.show', compact("annonce"));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$annonce  = Annonce::findOrFail($id);
    	if($annonce->user_id != Auth::user()->id)
        	return Redirect::to('/')->with('message', 'Ce profil n\'est pas le votre, vous ne pouvez donc pas le modifier !');
        return View::make('annonces.edit', compact("annonce"));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $annonce = Annonce::findOrFail($id);
        if($annonce->user_id != Auth::user()->id)
        	return Redirect::to('/')->with('message', 'Cette annonce n\'est pas la votre, vous ne pouvez donc pas la modifier !');
        $datas = Input::all();
		$files = Input::file('files');
        if(isset($files[0]) && !empty($files[0]) && is_null($annonce->photo1)){
        	$datas['photo1'] = $files[0]->getClientOriginalName();
        }elseif(isset($files[0]) && !empty($files[0]) && !is_null($annonce->photo1)){
        	$datas['photo2'] = $files[0]->getClientOriginalName();
        }
        if(isset($files[1]) && !empty($files[1]) && is_null($annonce->photo2)){
        	$datas['photo2'] = $files[1]->getClientOriginalName();
    	}elseif(isset($files[1]) && !empty($files[1]) && !is_null($annonce->photo2)){
        	$datas['photo3'] = $files[1]->getClientOriginalName();
        }
        if(isset($files[2]) && !empty($files[2]) && is_null($annonce->photo3)){
        	$datas['photo3'] = $files[2]->getClientOriginalName();
        }elseif(isset($files[2]) && !empty($files[2]) && !is_null($annonce->photo2)){
        	$datas['photo3'] = $files[2]->getClientOriginalName();
        }

		$validator = Validator::make(Input::all(), Annonce::$rules);
		if($validator->passes()) $annonce->update($datas);


		if(!empty($datas['photo1']) || !empty($datas['photo2']) || !empty($datas['photo3'])){
	        foreach ($files as $file) {
				$path = public_path(strtolower('uploads'.DIRECTORY_SEPARATOR.$annonce->id));
				$filename = strtolower($file->getClientOriginalName());
				$extension = strtolower($file->getClientOriginalExtension());
				$mime = $file->getMimeType();
				$file->move($path, $filename);
		    }
		}
        return Redirect::to('/')->with('message', 'Votre annonce a bien été édité !');
	}

	public function getDelete($id){
		$annonce = Annonce::findOrFail($id);
        if($annonce->user_id != Auth::user()->id && Auth::user()->role_id != 2){
            return Redirect::to('account')->with('error', 'Cette annonce n\'est pas votre propriété, vous ne pouvez donc pas le partager !');
        }
        Annonce::destroy($id);
        return Redirect::to('account')->with('message', 'L\'annonce a bien été supprimé');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}


}
