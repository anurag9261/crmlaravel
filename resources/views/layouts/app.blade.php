<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM | Admin Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    body {
        color: #999;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
    }

    .form-control {
        box-shadow: none;
        border-color: #ddd;
    }

    .form-control:focus {
        border-color: #4aba70;
    }

    .login-form {
        width: 550px;
        margin: 0 auto;
        padding: 30px 0;
    }

    .login-form form {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form h4 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }


    .login-form .avatar i {
        font-size: 62px;
    }

    .login-form .form-group {
        margin-bottom: 20px;
    }

    .login-form .form-control,
    .login-form .btn {
        min-height: 40px;
        border-radius: 2px;
        transition: all 0.5s;
    }

    .login-form .close {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .login-form .btn {
        background: #595959;
        border: none;
        line-height: normal;
    }

    .login-form .btn:hover,
    .login-form .btn:focus {
        background: #4d4d4d;
    }

    .login-form .checkbox-inline {
        float: left;
    }

    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }

    .login-form .forgot-link {
        float: right;
    }

    .login-form .small {
        font-size: 13px;
    }

    .login-form a {
        color: #0080ff;
    }
    </style>
    
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
