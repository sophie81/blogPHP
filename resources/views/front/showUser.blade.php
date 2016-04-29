@extends('layouts.master')

@section('title', $title)
@section('content')
	@if(!empty($user))
	
	<h1>{{$user->name}}</h1>
	@forelse($user->posts as $post)
	<h2><a href="{{url('article',[$post->id])}}">{{$post->title}}</a></h2>
	@if($post->category)
	<p><b>Catégorie :</b> {{$post->category->title}}</p>
	@endif
@empty
	<p>Pas d'article forelse</p>
@endforelse

	@else
	<p>Pas d'auteur</p>
	@endif
@endsection