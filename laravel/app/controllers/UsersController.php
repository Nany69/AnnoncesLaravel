<?php

class UsersController extends BaseController {
    protected $layout = "layouts.master";

    public function __construct(){
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

	public function getRegister() {
        if(Auth::check()){ return Redirect::to('/')->with('error', 'Vous ne pouvez pas vous inscrire en étant déjà connecté');}
	    $this->layout->content = View::make('users.inscription');
	}

	public function postCreate() {
    	$validator = Validator::make(Input::all(), User::$rules);
		if($validator->passes()){
		    $user = new User;
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $confirmation_code = str_random(30);
            $user->confirmation_code = $confirmation_code;
		    $user->save();
            Mail::send('emails.confirmation', $user->toArray() , function($message) {
                $message->from('robin.chalas@gmail.com', 'Free-Ads');
                $message->to(Input::get('email'), Input::get('username'))
                    ->subject('Confirmation de votre inscription');
            });
		    return Redirect::to('users/login')->with('message', 'Vous êtes désormais inscris ! Un mail d\'activation de votre compte vous a été envoyé.');
		}else{
		    return Redirect::to('inscription')->with('error', 'Veuillez corriger les erreurs suivantes')->withErrors($validator)->withInput();
		}
	}

    public function confirm($confirmation_code)
    {
        if(!$confirmation_code)throw new Exception('Code de confirmation faux ou inexistant !');
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if(!$user)throw new Exception('Code de confirmation faux ou inexistant !');
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        return Redirect::to('users/login')->with('message', 'Votre compte est bien activé, vous pouvez vous connecter dés maintenant');
    }

	public function getLogin() {
        if(Auth::check()){ return Redirect::to('/')->with('error', 'Vous êtes déjà connecté');}
	    $this->layout->content = View::make('users.login');
	}

	public function postSignin(){
		if(Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
            if(Auth::user()->role_id == 0){
                Auth::logout();
                return Redirect::to('users/login')->with('error', 'Votre compte a été bloqué !')->withInput();
            }elseif(Auth::user()->confirmed != 1){
                Auth::logout();
                return Redirect::to('users/login')->with('error', 'Votre compte n\'a pas été activé, consultez votre boîte mail !')->withInput();
            }
    	    return Redirect::to('/')->with('message', 'Vous êtes connecté !');
		}else{
    		return Redirect::to('users/login')
	        ->with('error', 'Votre username/password est incorrect !')
	        ->withInput();
		}
	}

	public function getDashboard() {
    	return View::make('users.dashboard');
	}

	public function getLogout() {
    	Auth::logout();
    	return Redirect::to('/')->with('error', 'Vous êtes déconnecté !');
	}

    public function getEdit($id){
        $user = User::findOrFail($id);
        if($user->id != Auth::user()->id)
            return Redirect::to('/')->with('error', 'Ce profil n\'est pas le votre, vous ne pouvez donc pas le modifier !');
        return View::make('users.edit', compact("user"));
    }

    public function postEdit($id){
        $user = User::findOrFail($id);
        if($user->id != Auth::user()->id)
            return Redirect::to('/')->with('error', 'Ce profil n\'est pas le votre, vous ne pouvez donc pas le modifier !');
            if(empty(Input::get('password'))){
                $datas = Input::only('email');
            }else{
                $datas = Input::only('password','email');
                $datas['password'] = Hash::make($datas['password']);
            }
            $user->update($datas);
            return Redirect::to('/')->with('message', 'Votre profil a bien été édité !');
    }

    public function showAccount(){
        $id = '[0-9]+';
        $userid = Auth::user()->id;
        $user = User::where('id', '=', Auth::user()->id)->get();
        $annonces = Annonce::where('user_id', '=', $userid)->orderBy('id', 'desc')->paginate(3);
        Return View::make('users.account')->with('user', $user)->with('annonces', $annonces);
    }

     public function getDelete($id){
        $user = User::findOrFail($id);
        if($user->id != Auth::user()->id && Auth::user()->role_id != 2){
            return Redirect::to('account')->with('error', 'Ce profil n\'est pas votre propriété, vous ne pouvez donc pas le supprimer!');
        }
        User::destroy($id);
        return Redirect::to('/')->with('error', 'Le compte a bien été supprimé');
    }

}