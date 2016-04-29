@extends('layouts.master')
@section('content')
    @if(Session::has('message'))
        <p>{{Session::get('message')}}</p>
    @endif

    <form method="POST" action="{{url('login')}}" class="login">
        {{ csrf_field() }}
        <div class="mb10">
            Email : <br>
            <input type="email" name="email">
            @if($errors->has('email'))
                <p><span class="error">{{$errors->first('email')}}</span></p>
            @endif
        </div>
        <div class="mb10">
            Password : <br>
            <input type="password" name="password" id="password">
            @if($errors->has('password'))
                <p><span class="error">{{$errors->first('password')}}</span></p>
            @endif
        </div>
        <div class="mb20">
            <input id="remember" type="radio" name="remember" value="remember"> Remember Me
        </div>
        <div>
            <button type="submit" class="btn btn-valid">Login</button>
        </div>
    </form>
@endsection