<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class LoginController extends Controller
{
	
    public function login(Request $request){
		 
		 if($request->isMethod('post')){
			 $this->validate($request, [
				 'email' => 'required|email', 
				 'password' => 'required',
				 'remember' => 'in:remember'
			 ]);
			 
			 $remember = !empty($request->input('remember')) ? true:false;
			 
			 $credentials = $request->only('email', 'password');
			 
			 if(Auth::attempt($credentials, $remember)){
				 return redirect('post')->with(['message', 'Vous êtes maintenant connecté !']);
			 }else{
				 return back()->withInput($request->only('email', 'remember'))->with(['message' => 'Erreur lors de l\'authentification, veuillez vérifier votre adresse mail ou votre mot de passe !']);
			 }
		 }else{
			 return view('auth.login');
		 }
		 
	 }
	
	public function logout(){
		Auth::logout();
		
		return redirect('/')->with(['message', 'Vous êtes bien déconnecté !']);
	}
}
