<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Home | CtgPort</title>
    <link rel="shortcut icon" href="{{asset('/assets/images/logo.png')}}">
    <link rel="apple-touch-icon image_src" href="{{asset('/assets/images/logo.png')}}">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/responsive-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/customer-css.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>
<body>
 <div>
     <header>
         <div class="wrapper header-bar" id="adm-header-bar">

             <div class="container-fluid">
                 <div class="row">
                     <div class="col-md-2">
                         <div id="adm-logo">
                             <img src="{{asset('assets/admins/images/logo-1.png')}}" class="img-fluid" alt="logo">
                         </div>
                     </div>
                     <div class="col-md-5">
                         <div class="nav-wrapper">
                             <nav class="navbar navbar-expand-md navbar-toggleable-sm">
                                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adm-navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                                 </button>
                                 <div class="collapse navbar-collapse" id="adm-navbar">
                                     <ul class="navbar-nav">
                                         <li class="nav-item"><a href="{{url('/customer/home')}}" class="nav-link">Home</a></li>

                                     </ul>
                                 </div>
                             </nav>
                         </div>
                     </div>
                     <div class="col-md-3">
                        <!--  <div class="dropdown">
                             <button style="background-color: transparent; padding-top: 10px;color: #fff;" class="btn btn-block text-center dropdown-toggle" type="button" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Notification
                             </button>
                             <div class="dropdown-menu" aria-labelledby="notificationButton">
                                 <a class="dropdown-item" href="">Mohammad forkan applied for a sticker</a>
                                 <a class="dropdown-item" href="">....</a>
                             </div>
                         </div> -->
                     </div>
                     <div class="col-md-2">
                         <div id="adm-account">
                             <div class="dropdown">
                                 <button class="btn btn-block text-center dropdown-toggle"  type="button" id="adminMenuButton" data-toggle="dropdown" style="" aria-haspopup="true" aria-expanded="false">
                                     {{isset(auth()->guard('applicant')->user()->name) ? auth()->guard('applicant')->user()->name : ''}}
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="adminMenuButton">
                                   <!--   <a class="dropdown-item" href="">Your Account</a> -->

                                     <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('Customer-logout-form').submit();">Logout</a>
                                     <form id="Customer-logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                         {{ csrf_field() }}

                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>

     </header>
     <div class="wrapper main-content" id="app-main-content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-2">
                     <div class="sidebar" id="app-sidebar" style="background-color: #b1e0f3;">
                         <img src="{{isset(auth()->guard('applicant')->user()->applicantDetail->applicant_photo) ? auth()->guard('applicant')->user()->applicantDetail->applicant_photo : ''}}" class="img-fluid" height="150" width="150" alt="">
                         <h5>{{isset(auth()->guard('applicant')->user()->name) ? auth()->guard('applicant')->user()->name : ''}}</h5>
                         <a href="{{url('/about/customer')}}">About Me</a>
                         <a href="{{url('/customer/home')}}">Apply for Another Sticker</a>
                         <a href="{{url('/applied-applications')}}">Applied Applications</a>
                         <a href="{{url('/alocated-stickers')}}">Allocated Stickers</a>
                     </div>
                 </div>
                 @yield('content')
             </div>
         </div>
     </div>


     @include('layouts.footer')
 </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" defer=""></script> 
<script src="{{ asset('/assets/sweetalert2/dist/sweetalert2.min.js') }}" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @yield('script')
</body>
</html>
