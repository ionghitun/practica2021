<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign In</title>
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    </head>
    <body class="hold-transition login-page">
        @yield('content')

        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
