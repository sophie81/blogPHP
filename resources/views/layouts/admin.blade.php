<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            @yield('title', 'BlogPHP')
        </title>
        <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
        <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body class="mw960p mauto">
        <header>
            <h1>BlogPHP</h1>
            <nav>
                @include('partials.navAdmin')
            </nav>
        </header>
        <div class="main">
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer>
            @section('footer')
                <p> Sophie RIVIERE - 2016</p>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="{{url('assets/js/app.min.js')}}"></script>
    </body>
</html>