<?php

class IndexController extends BaseController {

    public function __construct(){

        //$this->beforeFilter('auth', array('only'=>array('showIndex')));
    }
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function showIndex()
	{
		$id = '[0-9]+';
		$annonces = Annonce::orderBy('id', 'desc')->paginate(3);
        Return View::make('index.index')->with('annonces', $annonces);
	}

	public function searchAds(){
		//$id = '[0-9]+';
		if(empty(Input::get('keywords')) && empty(Input::get('prix')) && empty(Input::get('category')))
			$annonces = Annonce::orderBy('id', 'desc')->paginate(3);
		if(!empty(Input::get('keywords'))){
	   		$annonces = Annonce::where('titre', 'like', '%'.Input::get('keywords').'%')
	   		->where('description', 'like', '%'.Input::get('keywords').'%', 'OR')->paginate(400);
		}elseif(!empty(Input::get('prix'))){
			if(Input::get('prix') == 0){
				$annonces = Annonce::orderBy('prix', 'asc')->get();
			}elseif(Input::get('prix') == 1){
				$annonces = Annonce::where('prix', '<=', '100')->orderBy('prix', 'asc')->paginate(400);
			}elseif(Input::get('prix') == 2){
				$annonces = Annonce::where('prix', '>=', '100')
									->where('prix', '<=', '300', 'AND')->orderBy('prix', 'asc')->paginate(400);
			}elseif(Input::get('prix') == 3){
				$annonces = Annonce::where('prix', '>=', '300')
									->where('prix', '<=', '500', 'AND')->orderBy('prix', 'asc')->paginate(400);
			}elseif(Input::get('prix') == 4){
				$annonces = Annonce::where('prix', '>=', '500')
									->where('prix', '<=', '1000', 'AND')->orderBy('prix', 'asc')->paginate(400);
			}elseif(Input::get('prix') == 5){
				$annonces = Annonce::where('prix', '>', '1000')->orderBy('prix', 'asc')->paginate(400);
			}
		}elseif(!empty(Input::get('category'))){
			$annonces = Annonce::where('category', '=', Input::get('category'))->paginate(400);
	   	}
	   	if($annonces->count() === 0){
	   		return Redirect::to('/')->with('error', 'Aucun résultat trouvé');
	   	}
        Return View::make('index.index')->with('annonces', $annonces);
	}



}
