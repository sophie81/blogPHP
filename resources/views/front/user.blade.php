@extends('layouts.master')

@section('title', $title)
@section('content')

@forelse($users as $user)
<h2><a href="{{url('user',[$user->id])}}">{{$user->name}}</a></h2>
@empty
	<p>Pas d'auteurs</p>
@endforelse
@endsection

@section('sidebar')
@parent
<p>2016 - RIVIERE Sophie</p>
@endsection