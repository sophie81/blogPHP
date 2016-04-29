@extends('layouts.master')

@section('title', $title)
@section('content')
    @if(!empty($category))
        <h2>Catégorie : {{$category->title}}</h2>
        @forelse($category->posts as $post)
            <h3><a href="{{url('article',[$post->id])}}">{{$post->title}}</a></h3>
            @if($post->picture)
                <div class="picture">
                    <img src="{{url('uploads', $post->picture->uri)}}" width="370">
                </div>
            @endif
            <div class="txtleft">
                <p>{{excerpt($post->content)}}</p>
                @if($post->user)
                    <p><b>Auteur :</b> <a href="{{url('user',[$post->user->id])}}">{{$post->user->name}}</a></p>
                @endif
                @if($post->tags)
                    <p><b>Tags :</b>
                        @forelse($post->tags as $tag)
                            {{$tag->name}}
                        @empty
                        @endforelse
                    </p>
                @endif
                @if($post->published_at)
                    <p><b>Plublié le :</b> {{$post->published_at->format('d/m/Y')}}</p>
                @endif
            </div>
        @empty
            <p>Pas de catégorie</p>
        @endforelse
    @endif
@endsection