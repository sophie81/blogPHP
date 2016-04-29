@extends('layouts.master')

@section('title', $title)

@section('content')
    <h2>Conférences et nouveautés</h2>
    {{ $posts->links() }}
    @forelse($posts as $post)
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
            @if($post->category)
                <p><b>Catégorie :</b> {{$post->category->title}}</p>
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
        <p>Pas d'article forelse</p>
    @endforelse
    {!! $posts->links() !!}
@endsection

@section('footer')
    @parent
    <p>2016 - RIVIERE Sophie</p>
@endsection