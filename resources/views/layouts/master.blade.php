<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CtgPort</title>
    <link rel="shortcut icon" href="{{asset('/assets/images/logo.png')}}">
    <link rel="apple-touch-icon image_src" href="{{asset('/assets/images/logo.png')}}">

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/owl.theme.green.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/responsive-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">





</head>
<body>
    @include('layouts.header')
    @include('layouts.nav_bar')
         @yield('content')
    @include('layouts.footer')
<!-- Scripts -->

<script src="{{ asset('/assets/js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('/assets/js/bootstrap.js') }}" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @yield('script')
</body>
</html>
