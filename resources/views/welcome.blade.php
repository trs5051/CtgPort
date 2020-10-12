
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title tag -->
    <title>
        চট্টগ্রাম বন্দর কর্তৃপক্ষ
    </title>

    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/frontend') }}/images/ctg-logo.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css">
    <style>
        *{font-family: kalpurush!important;}
        .fa, .far, .fas {
            font-family: "Font Awesome 5 Free"!important;;
        }
        
    </style>

</head>
<body>
    <!-- site-wrapper -->
    <div class="site-wrapper">
        <!-- site-header -->
        <header class="site-header">
            <!-- header-top-area -->
            <div class="header-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 header-top-left">
                            {{-- ৩১ জানুয়ারী, ২০১৯ --}}
                            <?php 
                          
                           echo bangla_date(time(),"en")
                           ?>
                        </div>

                        <div class="col-lg-6 header-top-right text-right">
                            <ul class="navbar nav">
                                <li><a href="{{ url('/customer/login') }}">লগইন</a></li>
                                <li><a href="{{ url('/customer/register') }}"> রেজিস্টার </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- header-logo-area -->
            <div class="header-logo-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 logo">
                            <a href="http://ctgport.xyz/">
                                <img src="{{ asset('assets/frontend') }}/images/ctg-logo.png" alt="ctg-logo">
                                <div class="site-desc">
                                    <img src="{{ asset('assets/frontend') }}/images/logo-text.png" alt="ctg-desc">
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-6 header-info text-right">
                            <ul style="font-family: sarif;">
                                <li><i class="fas fa-map-marker"></i> Bandar Bhaban, Chattogram-4100, Bangladesh</li>
                                <li><i class="fas fa-envelope"></i> info@cpa.gov.bd</li>
                                <li><i class="fas fa-phone-volume"></i> Tel: +880-31-2522200-29</li>
                                <li><i class="fas fa-fax"></i> Fax: +880-31-2510889</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>        
        
        <!-- main-slider -->
        <div id="main-slider" class="carousel slide carousel-fade main-slider" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
                <li data-target="#main-slider" data-slide-to="3"></li>
                <li data-target="#main-slider" data-slide-to="4"></li>
                <li data-target="#main-slider" data-slide-to="5"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-1.jpg" alt="CTG Port">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-2.jpg" alt="CTG Port">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-3.jpg" alt="CTG Port">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-4.jpg" alt="CTG Port">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-5.jpg" alt="CTG Port">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/frontend') }}/images/mslider/slide-5.jpg" alt="CTG Port">
                </div>
            </div>
            <a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#main-slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="main-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-menu-wrapper">
                            <ul class="navbar nav main-menu">
                                <li><a href="http://ctgport.xyz/"><i class="fa fa-home"></i></a></li>
                                <li>
                                    <a href="#">যানবাহন স্টিকার </a>
                                    <ul class="sub-menu">
                                        <li><a href="http://ctgport.xyz/assets/pdf/pdf-at-iframe.pdf" target="_blank">নিতিমালা </a></li>
                                        <li><a href="http://ctgport.xyz/">টিউটরিয়াল </a></li>
                                        <li><a href="http://ctgport.xyz/">রেজিস্টার </a></li>
                                        <li><a href="http://ctgport.xyz/">লগইন </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">যানবাহন অস্থায়ী পাশ </a>
                                    <ul class="sub-menu">
                                        <li><a href="http://ctgport.xyz/assets/pdf/pdf-at-iframe.pdf" target="_blank">নিতিমালা </a></li>
                                        <li><a href="http://ctgport.xyz/">টিউটরিয়াল </a></li>
                                        <li><a href="http://ctgport.xyz/">রেজিস্টার </a></li>
                                        <li><a href="http://ctgport.xyz/">লগইন </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="http://pv.ctgport.xyz/">পুলিশ ভেরিফিকেশন </a>
                                    <ul class="sub-menu">
                                        <li><a href="http://pv.ctgport.xyz/">নিতিমালা </a></li>
                                        <li><a href="http://ctgport.xyz/assets/pdf/police-varifiaction-tutorial.pdf">টিউটরিয়াল </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">বিজ্ঞপ্তি </a>
                                </li>
                                <li><a href="http://ctgport.xyz/contact">যোগাযোগ </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>            
        </div>

        <div class="notice-chairman-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 primary-content-area">

                        <div class="row">
                            <div class="col-12">
                                <!-- ctg-card notice-->
                                <div class="ctg-card notice-card">
                                    <img src="{{ asset('assets/frontend') }}/images/bg_notice_board.png" class="asbg" alt="">

                                    <h5 class="ctg-card-title">
                                        নোটিশ বোর্ড 
                                    </h5>

                                    <ul class="ctg-list">
                                        <li><a href="http://ctgport.xyz/assets/pdf/pdf-at-iframe.pdf" target="_blank">যানবাহনের স্টিকারের আবেদনের নিতিমালা।   </a></li>
                                        <li><a href="http://ctgport.xyz/assets/pdf/Ctgport-Vehicle-Sticker-Catalog.pdf" target="_blank">যানবাহনের স্টিকারের আবেদনের টিউটরিয়াল। </a></li>
                                        <li><a href="http://ctgport.xyz/#">&nbsp;</a></li>
                                        <li><a href="http://ctgport.xyz/#">&nbsp;</a></li>
                                        <li><a href="http://ctgport.xyz/#">&nbsp;</a></li>
                                    </ul>

                                    <!--<div class="all-links">-->
                                    <!--    <a href="{{ asset('assets/frontend') }}/all-notices.html">সকল লিঙ্ক  <i class="fas fa-angle-double-right"></i></a>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>


                        <div class="row">                            
                            <div class="col-6"> 
                                <!-- ctg-card  -->
                                <div class="ctg-card style-2">
                                    <h5 class="ctg-card-title">
                                        যানবাহন স্টিকার
                                    </h5>

                                    <div class="ctg-card-desc">      
                                        <div class="cimage-wrap">
                                            <img src="{{ asset('assets/frontend') }}/images/services/notice-(1).png" class="asbg" alt="">
                                        </div>                                  
                                        

                                        <ul class="ctg-list">
                                            <li><a href="http://ctgport.xyz/assets/pdf/pdf-at-iframe.pdf" target="_blank">নিতিমালা </a></li>
                                            <li><a href="http://ctgport.xyz/assets/pdf/Ctgport-Vehicle-Sticker-Catalog.pdf" target="_blank">টিউটরিয়াল </a></li>
                                            <li><a href="http://ctgport.xyz/customer/register">রেজিস্টার </a></li>
                                            <li><a href="http://ctgport.xyz/customer/login">লগইন </a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>

                            <div class="col-6"> 
                                <!-- ctg-card  -->
                                <div class="ctg-card style-2">
                                    <h5 class="ctg-card-title">
                                        যানবাহন অস্থায়ী পাশ 
                                    </h5>

                                    <div class="ctg-card-desc">                             
                                        <div class="cimage-wrap">
                                            <img src="{{ asset('assets/frontend') }}/images/services/INFO-111.png" class="asbg" alt="">
                                        </div>  

                                        <ul class="ctg-list">
                                            <li><a href="http://ctgport.xyz/assets/pdf/pdf-at-iframe.pdf" target="_blank">নিতিমালা </a></li>
                                            <li><a href="http://ctgport.xyz/assets/pdf/Ctgport-Vehicle-Sticker-Catalog.pdf" target="_blank">টিউটরিয়াল </a></li>
                                            <li><a href="http://ctgport.xyz/customer/register">রেজিস্টার </a></li>
                                            <li><a href="http://ctgport.xyz/customer/login">লগইন </a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>        

                            <div class="col-6"> 
                                <!-- ctg-card  -->
                                <div class="ctg-card style-2">
                                    <h5 class="ctg-card-title">
                                        পুলিশ ভেরিফিকেশন 
                                    </h5>

                                    <div class="ctg-card-desc">                             
                                        <div class="cimage-wrap">
                                            <img src="{{ asset('assets/frontend') }}/images/services/service-111.png"  class="asbg" alt="">
                                        </div>  

                                        <ul class="ctg-list">
                                            <li><a href="http://pv.ctgport.xyz/" target="_blank">আবেদন খুজতে  </a></li>
                                            <li>
                                                <a href="http://ctgport.xyz/assets/pdf/police-varifiaction-tutorial.pdf" target="_blank">
                                                টিউটরিয়াল
                                                </a>
                                            </li>
                                            <li><a href="http://pv.ctgport.xyz/" target="_blank">&nbsp;</a></li>
                                            <li><a href="http://pv.ctgport.xyz/" target="_blank">&nbsp;</a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>

                            <div class="col-6"> 
                                <!-- ctg-card  -->
                                <div class="ctg-card style-2">
                                    <h5 class="ctg-card-title">
                                        বিজ্ঞপ্তি
                                    </h5>

                                    <div class="ctg-card-desc">                              
                                        <div class="cimage-wrap">
                                            <img src="{{ asset('assets/frontend') }}/images/services/office-order.png" alt="">
                                        </div>  

                                        <ul class="ctg-list">
                                            <li><a href="http://ctgport.xyz/#">নিয়োগ বিজ্ঞপ্তি </a></li>
                                            <li><a href="http://ctgport.xyz/#" target="_blank">ফলাফল </a></li>
                                            <li><a href="http://ctgport.xyz/#" target="_blank">দরপত্র বিজ্ঞপ্তি </a></li>
                                            <li><a href="http://ctgport.xyz/#" target="_blank">এনওএ</a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>                        
                        </div>
                    </div>


                    <div class="col-md-4 secondary-content-area">
                        <!-- chairman -->
                        <div class="widget chairman">
                            <h5 class="widget-title">
                                চেয়ারম্যান 
                            </h5>

                            <div class="widget-content">
                                <img src="{{ asset('assets/frontend') }}/images/chairman-of-this-org.png" alt="chairman" width="170">

                                <p>সত্তরের দশকে আন্তর্জাতিক বাণিজ্যে কন্টেইনার পদ্ধতি প্রবর্তনের পরবর্তীতে বিবিধ পরিবর্তনের মধ্য দিয়ে এগিয়েছে বিশ্বের বন্দরসমূহ। বাধাবিপত্তি সত্ত্বেও...... 
                                <a href="{{ asset('assets/frontend') }}/images/Chairman message_Bangla.pdf" target="_blank">আরো পড়তে ক্লিক করুন </a></p>
                            </div>

                        </div>

                        <div class="widget">
                            <h5 class="widget-title">
                                গুরুত্বপূর্ণ লিংক
                            </h5>

                            <div class="widget-content">
                                <ul class="widget-list">
                                    <li><a href="http://180.211.172.153:7001/CpaBillStatus/" target="_blank">অনলাইন ভেসেল বিল (বন্দর বহির্ভূত নেটওয়ার্ক) </a></li>
                                    <li><a href="http://192.168.4.13:7001/CpaBillStatus/index.html" target="_blank">অনলাইন ভেসেল বিল (বন্দর নেটওয়ার্ক) </a></li>
                                    <li><a href="http://pict.gov.bd/" target="_blank">পানগাঁও কন্টেইনার টার্মিনাল </a></li>
                                    <li><a href="http://mos.gov.bd/" target="_blank">নৌ-পরিবহন মন্ত্রণালয় </a></li>
                                    <li><a href="http://mos.gov.bd/" target="_blank">হাউজ এলোটমেন্ট সিস্টেম </a></li>
                                    <li><a href="http://biwta.gov.bd/" target="_blank">বিআইডব্লিউটিএ </a></li>
                                    <li><a href="http://brta.gov.bd/" target="_blank">বাংলাদেশ রোড ট্রান্সপোর্ট অথরিটি </a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- map-area -->
        <div class="map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.1527775036666!2d91.79826021495491!3d22.31006108531851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acdf250bff95bf%3A0x253978de79dca90e!2z4Kaa4Kaf4KeN4Kaf4KaX4KeN4Kaw4Ka-4KauIOCmrOCmqOCnjeCmpuCmsA!5e0!3m2!1sbn!2sbd!4v1523429424083" width="100%" height="320" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div> 

        <!-- site-footer -->
        <footer class="site-footer">
            <!-- footer-top-area -->
            <div class="footer-top-area">
                <img src="{{url('/assets/images/footer-bg.gif')}}" alt="" width="100%">
            </div>
            <!-- footer-bootom-area -->
            <div class="footer-bootom-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="footer-left">
                                <ul class="navbar nav footer-left-menu">
                                    <li><a href="http://ctgport.xyz/contact">যোগাযোগ</a></li>
                                    <!--<li><a href="#" style="pointer-events: none; cursor: default; text-decoration: none; color: black;">ফিডব্যাক</a></li>-->
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="footer-right text-right" style="background: url({{url('/assets/images/sl.png')}}) no-repeat scroll 200px 0 / 40px;">
                                <div class="plan">
                                    পরিকল্পনা ও বাস্তবায়নেঃ পরিচালক (নিরাপত্তা দপ্তর)।
                                </div>
                                <div class="desingn-by">
                                    কারিগরি সহায়তায়ঃ
                                    <a href="https://ennvisiodigital.tech/"  target="_blank">Ennvisio Digital Pvt. Ltd.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </footer> 

    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/js/main.js"></script>
  </body>
</html>