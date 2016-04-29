@extends('layouts.admin')

@if(Session::has('message'))
    <p class="msg mb20">{{Session::get('message')}}</p>
@endif
@section('content')
    <form action="{{url('post', [$post->id])}}" method="POST" enctype="multipart/form-data" class="ml100">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="_method" value="PATCH">

        <div class="mb20">
            <p class="label">Titre : </p><input type="text" name="title" value="{{$post->title}}">
            @if($errors->has('title'))
                <p><span class="error">{{$errors->first('title')}}</span></p>
            @endif
        </div>

        <div class="picture" class="mb20">
            @if($post->picture)
                <p class="label">Image : </p>
                <img src="{{url('uploads', $post->picture->uri)}}" width="185"><br>
                <p class="label">Nom de l'image :</p><input type="text" name="name" value="{{$post->picture->name}}"><br>
                @if($errors->has('name'))
                    <p><span class="error">{{$errors->first('name')}}</span></p>
                @endif
                <p class="label">Voulez-vous supprimer l'image ? </p><input type="checkbox" name="suppr" value="Supprimer">
                    oui<br>
                <p class="label">Sélectionnez une nouvelle image : </p><input type="file" name="picture">
                @if($errors->has('picture'))
                    <p><span class="error">{{$errors->first('picture')}}</span></p>
                @endif
            @else
                <p class="label">Nom de l'image : </p><input type="text" name="name"></br>
                @if($errors->has('name'))
                    <p><span class="error">{{$errors->first('name')}}</span></p>
                @endif
                <p class="label">Choisissez une image : </p><input type="file" name="picture">
                @if($errors->has('picture'))
                    <p><span class="error">{{$errors->first('picture')}}</span></p>
                @endif
            @endif
        </div>

        <div class="mb20">
            <p class="label">Texte : </p><textarea name="content">{{$post->content}}</textarea>
        @if($errors->has('content'))
            <p><span class="error">{{$errors->first('content')}}</span></p>
        @endif
        </div>

        <div class="mb20">
            <p class="label">Sélectionnez une categorie : </p>
            <select name="category_id">
                @forelse($categories as $id=>$title)
                    <option {{$post->category_id==$id? 'selected' : ''}} value="{{$id}}">{{$title}}</option>
                @empty
                    <p>Pas de catégorie</p>
                @endforelse
            </select>
        </div>

        <div class="mb20">
            <p class="label">Tags : </p>
            <div class="tag">
            @forelse($tags as $id=>$name)
                <input {{$post->hasTag($id)? 'checked' : ''}} type="checkbox" name="tag_id[]" value="{{$id}}">
                {{$name}}<br>
            @empty
                <p>Pas de tags</p>
            @endforelse
            </div>
        </div>

        <div class="mb20">
            <p class="label">Date :</p>
            <input type="date" name="published_at" value="{{$post->published_at->format('Y-m-d')}}">
        </div>

        <div class="mb20">
            <input type="submit" value="Envoyer" class="btn btn-valid">
        </div>
    </form>
@endsection