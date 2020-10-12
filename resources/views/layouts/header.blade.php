<style type="text/css">
  .nav-item a:hover{
    color: #fff!important;
  }
</style>
<header>
      
      <div class="wrapper" id="home-header-bar">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    
                </div>
                <div class="col-md-3">
                    <ul>
                      @if(!auth()->guard('applicant')->check())


                      <li><a href="{{route('customer.login')}}">Login</a></li>
                      <li><a href="{{route('customer.register')}}">Register</a></li>
                      @else
                       <li class="nav-item dropdown" style="padding: 0; border-right: 0;">
                                <a id="navbarDropdown" style="padding:5px; " class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('applicant')->user()->name }} <span class="caret"></span>
                                </a>


                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" style="color: #000;" href="{{ url('/customer/home') }}" >
                                        {{ __('My Account') }}
                                    </a>
                                    <a class="dropdown-item" style="color: #000;" href="{{ route('customer.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                       {{csrf_field()}}
                                    </form>
                                    <style>
                                        .nav-item a.dropdown-item:hover {
                                            color: #000!important;
                                        }
                                    </style>
                                </div>
                              </li>
                     @endif 

                    </ul>
                </div>
                <div class="col-md-1">
                    
                </div>
            </div>
        </div>
         
      </div>

      <div class="wrapper" id="header">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-2">
                      <div id="logo">
                          <a href="{{url('/')}}">
                              <img src="{{asset('/assets/images/logo.png')}}" class="img-fluid" alt="cpa logo">
                          </a>
                      </div>
                  </div>
                  <div class="col-md-6 col-lg-7">
                      <div id="header-img" style="margin-top:15px">
                          <a href="/">
                              <img src="{{asset('/assets/images/logo-text.png')}}" class="img-fluid" alt="header image">
                          </a>
                      </div>
                  </div>
                  <div class="col-md-4 col-lg-3">
                    <div class="header-info">
                      <ul>
                        <li> <i class="fas fa-map-marker"></i> Bandar Bhaban, Chattogram-4100, Bangladesh</li>
                        <li><i class="fas fa-envelope"></i> info@cpa.gov.bd</li>
                        <li><i class="fas fa-phone-volume"></i> Tel: +880-31-2522200-29</li>
                        <li><i class="fas fa-fax"></i> Fax: +880-31-2510889</li>
                      </ul>
                    </div>

                  </div>

              </div>
          </div>
        </div>
    </header>