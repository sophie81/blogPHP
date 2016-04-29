@extends('layouts.master')

@section('title', $title)
@section('content')
    @if(!empty($post))
        <article>
            <h2>{{$post->title}}</h2>
            @if($post->picture)
                <div class="picture">
                    <img src="{{url('uploads', $post->picture->uri)}}" width="370"></br>
                    <span><i>{{$post->picture->name}}</i></span>
                </div>
            @endif
            <div class="txtleft">
                <p>{{$post->content}}</p>
                @if($post->user)
                    <p><b>Auteur :</b> <a href="{{url('user',[$post->user->id])}}">{{$post->user->name}}</a></p>
                @endif
                @if(!is_null($post->category))
                    <p><b>Catégorie :</b> {{$post->category->title}}</p>
                @else
                    <p>Pas de catégorie</p>
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
        </article>
    @else
        <p>Pas d'article</p>
    @endif
@endsection
