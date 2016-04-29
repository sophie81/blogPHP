<?php

namespace App\Http\Controllers;

use App\Picture;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Cache;


class FrontController extends Controller
{
	 private $paginate = 10;

    public function index(Request $request){
		 $title = 'Home';

		 $key ='home'.$request->get('page');

		 if(Cache::has($key)){
			 $posts = Cache::get($key);
		 } else {
			 $posts = Post::with('category', 'user', 'tags', 'picture')
				 ->opened()
				 ->paginate($this->paginate);

			 $expire = Carbon::now()->addMinute();

			 Cache::put($key, $posts, $expire);
		 }
		 
		 return view('front.index', compact('posts', 'title'));
	 }
	
	public function show($id){
		$title = 'Article';
		$post = Post::findOrFail($id);

		return view('front.show', compact('post', 'title'));
	 }
	
	public function user(){
		$title = 'Auteurs';
		$users = User::all();
		
		return view('front.user', compact('users', 'title'));
	}
	
	public function showUser($id){
		$title = 'Auteur';
		$user = User::findorFail($id);
		
		return view('front.showUser', compact('user', 'title'));
	}
	
	public function showCategory($id){
		$category = Category::findOrFail($id);
		$name = $category->title;
		$title = "Categorie : {$name}";
		
		return view('front.showCategory', compact('category', 'title'));
	}
	
}

