<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title', 'BlogPHP')
    </title>
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">

</head>
<body class="mw960p mauto">
<header>
    <h1>BlogPHP</h1>
    <nav>
        @include('partials.nav')
    </nav>
</header>
<div class="main grid-2">
    <div class="content">
        @yield('content')
    </div>

    <div class="sidebar">
        <div class="fixed">
            @section('sidebar')
                <h2>Nos sponsors</h2>
                <a href="https://www.elao.com/fr/la-tribu" target="_blank">
                    <img src="{{url('sponsors', 'elao_logo_150px.png')}}" class="mb20">
                </a><br>
                <a href="https://secure.php.net/manual/fr/index.php" target="_blank">
                    <img src="{{url('sponsors', 'Elephpant.png')}}" class="mb20">
                </a><br>
                <a href="http://jolicode.com/" target="_blank">
                    <img src="{{url('sponsors', 'logo-large.png')}}" class="mb20">
                </a><br>
                <a href="http://www.zol.fr/" target="_blank">
                    <img src="{{url('sponsors', 'zol-logo.png')}}" class="mb20">
                </a>
            @show
        </div>
    </div>
</div>
<footer>
    @section('footer')
        <p> Sophie RIVIERE - 2016</p>
</footer>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</body>
</html>