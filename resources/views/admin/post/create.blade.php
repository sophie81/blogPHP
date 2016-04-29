@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif

    <form action="{{url('post')}}" method="POST" enctype="multipart/form-data" class="ml100">
        {{csrf_field()}}
        <input type="hidden" name="user_id" value="{{$user_id}}">

        <div class="mb20">
            <p class="label">Titre :</p>
            <input type="text" name="title" value="{{old('title')}}">
            @if($errors->has('title'))
                <p><span class="error">{{$errors->first('title')}}</span></p>
            @endif
        </div>

        <div class="picture mb20">
            <p class="label">Nom de l'image : </p><input type="text" name="name"><br>
            <p class="label">Choisissez une image : </p><input type="file" name="picture">
        </div>

        <div class="mb20">
            <p class="label">Texte : </p><textarea name="content">{{old('content')}}</textarea>
            @if($errors->has('content'))
                <p><span class="error">{{$errors->first('content')}}</span></p>
            @endif
        </div>

        <div class="mb20">
            <p class="label">Sélectionnez une categorie : </p>
            <select name="category_id">
                @forelse($categories as $id=>$title)
                    <option value="{{$id}}">{{$title}}</option>
                @empty
                    <p>Pas de catégorie</p>
                @endforelse
                <option selected value="0">Pas de categorie</option>
            </select>
        </div>

        <div class="mb20">
            <p class="label">Status : </p>
            <select name="status">
                <option value="published">published</option>
                <option value="unpublished">unpublished</option>
            </select>
        </div>

        <div class="mb20">
            <p class="label">Tags : </p>
            <div class="tag">
                @forelse($tags as $id=>$name)
                    <input type="checkbox" name="tag_id[]" value="{{$id}}">{{$name}}<br>
                @empty
                    <p>Pas de tags</p>
                @endforelse
            </div>
        </div>

        <div class="mb20">
            <p class="label">Date :</p>
            <input type="date" name="published_at">
        </div>
        <div>
            <input type="submit" value="Envoyer" class="btn btn-valid">
        </div>
    </form>
@endsection