
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/sweetalert2/dist/sweetalert2.min.css') }}">

   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="{{asset('/assets/admins/css/style.css')}}">
    <title>Admin Panel | CPA</title>
    <link rel="shortcut icon" href="{{asset('/assets/images/logo.png')}}">
    <link rel="apple-touch-icon image_src" href="{{asset('/assets/images/logo.png')}}">
    
<script>
     window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
        ]) !!};
 </script>

</head>
<body>
<div id='app'>
    <header>
    <div class="wrapper header-bar" id="adm-header-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div id="adm-logo">
                        <img src="{{asset('assets/admins/images/logo-1.png')}}" class="img-fluid" alt="logo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="nav-wrapper">
                        <nav class="navbar navbar-expand-md navbar-toggleable-sm">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adm-navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                            </button>
                            <div class="collapse navbar-collapse" id="adm-navbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a href="{{url('/home')}}" class="nav-link">Home</a>
                                    </li>
                                     @if(auth()->user()->role === 'super-admin')
                                    <li class="nav-item"><a href="{{url('/admin-list')}}" class="nav-link">Admins</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
              <!--   <div class="col-md-3">
                    <div class="dropdown">
                        <button class="btn btn-block text-center dropdown-toggle" type="button" id="notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notification
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notificationButton">
                            <a class="dropdown-item" href="">Mohammad forkan applied for a sticker</a>
                            <a class="dropdown-item" href="">....</a>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-2">
                    <notification :userid="{{auth()->id()}}" :unreads="{{auth()->user()->unreadNotifications}}"></notification>
                </div>
                <div class="col-md-2">
                    <div id="adm-account">
                        <div class="dropdown">
                            <button class="btn btn-block text-center dropdown-toggle" type="button" id="adminMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="adminMenuButton">
                                <!-- <a class="dropdown-item" href="">Your Account</a> -->
                                <a class="dropdown-item" href="#myModal"
                                        data-toggle="modal" data-target="#myModal"><i class="fas fa-key"></i> Change Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
<div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="margin-left: auto;"><i class="fas fa-key"></i> Change Your Password </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form id="change_password_form">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <label for="" class="label-form">Type Old Password</label><span>*</span> <br>
                                    <small></small>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" name="old_password" id="app_old_pass" placeholder="old password" class="form-control in-form" value="">
                                </div> 
                                <div class="col-md-4 offset-md-1">
                                    <label for="" class="label-form">Type New Password</label><span>*</span> <br>
                                    <small></small>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" name="password" id="password" placeholder="new password" class="form-control in-form" value="">

                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <label for="" class="label-form">Type Confirm Password</label><span>*</span> <br>
                                    <small></small>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" name="password_confirmation" placeholder="retype new password" id="password_confirmation" class="form-control in-form" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<div class="wrapper main-content" id="adm-main-content">

    <div class="container-fluid">
        <div class="row">
                @yield('admin-sidebar')
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
</div>
<!-- Optional JavaScript -->

<script src="{{ asset('js/app.js') }}"></script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="{{asset('/assets/admins/js/pdfmake.min.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script> 
<script src="{{ asset('/assets/sweetalert2/dist/sweetalert2.min.js') }}" ></script>
<script src="{{asset('/assets/admins/js/print-pdf-custom.js')}}"></script>

<script>
$(document).ready(function() {
    // Accordion
    var accordion = document.getElementById("temp-pass");

    accordion.addEventListener("click", function() {

        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } 
        else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      });
    


    // noborder class adding in sidebar menu
     $("#temp-pass").click(function() {
      $("#temp-pass").toggleClass("noborder");
     });

    


} );

$(window).on('load', function(){
    if($("ul.temp-menu>li>a").hasClass("active")){
        $(this).parent("li").addClass("has");
        $("a#temp-pass").addClass("noborder");
        $("ul.temp-menu").css("max-height", "140px");

    }
});

</script>

@yield('admin-script')

</body>
</html>
