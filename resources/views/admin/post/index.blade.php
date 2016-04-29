@extends('layouts.admin')

@section('content')
    @if(Session::has('message'))
        <p class="msg mb20">{{Session::get('message')}}</p>
    @endif
    {{ $posts->links() }}
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Picture</th>
            <th>status</th>
            <th>Action (suppression)</th>
        </tr>
        </thead>
        <div id="confirm">
            <p>Confirmez vous la suppression de la resource <span></span> ?</p>
        </div>
        @forelse($posts as $post)
            <tr>
                <td>
                    {{$post->title}}
                </td>
                <td>
                    @if($post->user)
                        {{$post->user->name}}
                    @else
                        pas d'auteur
                    @endif
                </td>
                <td>
                    @if($post->published_at)
                        {{$post->published_at->format('d/m/Y')}}
                    @else
                        pas de date
                    @endif
                </td>
                <td>
                    @if($post->category)
                        {{$post->category->title}}
                    @else
                        pas de categorie
                    @endif
                </td>
                <td>
                    <ul class="tags">
                    @forelse($post->tags as $tag)
                        <li>{{$tag->name}} </li>
                    @empty
                        Pas de tag
                    @endforelse
                    </ul>
                </td>
                <td>
                    @if($post->picture)
                        <img src="{{url('uploads', $post->picture->uri)}}" width="185">
                        <span><i>{{$post->picture->name}}</i></span>
                    @else
                        <span>Pas d'image associée</span>
                    @endif
                </td>
                <td>
                    <a href="{{url("changeStatus", $post->id)}}" class="btn btn-valid">{{$post->status}}</a>
                </td>
                <td>
                    <a href="{{url('post',[$post->id, 'edit'])}}" class="btn btn-update mb10">Modifier</a>
                    <form class="destroy" method="POST" action="{{url('post', $post->id)}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="title_h" value="{{$post->title}}">
                        <input class="btn btn-closed" name="delete" type="submit" value="Supprimer">
                    </form>
                </td>

            </tr>
        @empty
            <p>aucun post</p>
        @endforelse
    </table>
    {!! $posts->links() !!}
@endsection