<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--    @vite(['resources/js/app.js','resources/css/app.css'])   --}}
    @vite('resources/sass/app.scss')
</head>
<body>

<div id="app">
    {{--        @yield('content')--}}
</div>

@section('sidebar')
    {{--        sidebar--}}
@show


<div class="container">
    @yield('content')
</div>
<footer>
    @vite('resources/js/app.js')
</footer>
</body>
</html>

