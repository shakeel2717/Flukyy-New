<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8"> <title>Flukyy.com / Get A Chance to Earn 1000 USD Dollars, Depsit Withdraw, Earn Money by Participating..</title>
    <meta name="description" content="Flukyy.com / Get A Chance to Earn 1000 USD Dollars, Depsit Withdraw, Earn Money by Participating..">
    <meta property="og:title" content="Flukyy.com / Get A Chance to Earn 1000 USD Dollars, Depsit Withdraw, Earn Money by Participating">
    <meta property="og:description" content="Flukyy.com / Get A Chance to Earn 1000 USD Dollars, Depsit Withdraw, Earn Money by Participating">
    <meta property="og:image" content="https://flukyy.comlanding/images/logo.png">
    <meta property="og:url" content="https://www.flukyy.com">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Flukyy">
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/elegant-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <style>
.iframe-container {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%;
}

.responsive-iframe {
  position:  absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}

</style>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('landing/images/favicon.png') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173992245-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173992245-1');
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/605a1ea9f7ce1827093321c3/1f1g0fi3n';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</head>
<body>
    <header class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                    <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="header-bar-email">
                            E-MAIL: <a href="#">contact@flukyy.com</a>
                        </div><!-- .header-bar-email -->
                    </div><!-- .col -->

                    <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                        <div class="donate-btn">
                            <a href="/register">Earn $1000</a>
                        </div><!-- .donate-btn -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .top-header-bar -->

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="index" rel="home"><img class="d-block" src="{{ asset('landing/images/logo.png') }}" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li class="<?php if(Route::currentRouteName() == "index" || Route::currentRouteName() == "/") {
                                    echo "current-menu-item";
                                }
                                ?>"><a href="/">Home</a></li>
                                <li class="<?php if(Route::currentRouteName() == "about") {
                                    echo "current-menu-item";
                                }
                                ?>"><a href="/about">About us</a></li>
                                <li class="<?php if(Route::currentRouteName() == "contact") {
                                    echo "current-menu-item";
                                }
                                ?>"><a href="/contact">Contact</a></li>
                            </ul>
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
    </header><!-- .site-header -->
    @yield('auth')
@yield('hero')
@yield('boxes-icon')
@yield('howto')
@yield('finaldesc')
    
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="#"><img src="{{ asset('landing/images/foot-logo.png') }}" alt=""></a></h2>
                            <div class="text-justify">
                            <p>Flukyy do not sell any coins, They are always earned free, from physical product (scratch cards), by watching promotion websites, discount cards, gift cards. Use flukyy coins to enroll in fluke and earn by chance than skills. Sale/Purchase of coins is prohibited on our plateform.</p>
                            </div>
                            <ul class="d-flex flex-wrap align-items-center">
                                <li><a href="https://www.instagram.com/flukyy1"><i class="fa-2x fa fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCcLvYMYJUTDpuihu9qtAmkg"><i class="fa-2x fa fa-youtube"></i></a></li>
                                <li><a href="https://www.facebook.com/pg/Flukyy-102459378301855"><i class="fa-2x fa fa-facebook"></i></a></li>
                            </ul>
                        </div><!-- .foot-about -->
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <h4 class="text-white">Useful Links</h4>
                        <ul>
                            <li><a href="/ourproducts">Our Products</a></li>
                            <li><a href="/productpage">Product Page</a></li>
                            <li><a href="/cards">Discount / Gift Card</a></li>
                            <li><a href="/discountstores">Discount Stores</a></li>
                            <li><a href="/promotionpolicy">Promotion Policy</a></li>
                            <li><a href="/privacypolicy">Privacy Policy</a></li>
                            <li><a href="/tos">Terms & Conditions</a></li>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/faq">Faq</a></li>
                            
                            
                        </ul>
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-latest-news">
                            <h2>Latest News</h2>

                            <ul>
                                <li>
                                    <h3><a href="#">Active account button do not work in spam mail box.</a></h3>
                                    <div class="posted-date">March 30, 2021</div>
                                </li>
                            </ul>
                        </div><!-- .foot-latest-news -->
                        <h2>Payment Method</h2>
                        <h2><a class="foot-logo" href="https://perfectmoney.com/?ref=3899365"><img src="{{ asset('landing/images/payment.jpg') }}" width="150" alt=""></a></h2>
                    </div><!-- .col -->

                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <h2>Server Date & Time</h2>
                        <h5><?php $mytime = Carbon\Carbon::now();
                            echo $mytime->toDateTimeString(); ?></h5>
                            <hr>
                        <h2>Subscribe Newsletter</h2>
                        <p>Enter Your Email to Get newly Update in your Email inbox.</p>
                        <div class="subscribe-form">
                            <form class="d-flex flex-wrap align-items-center" method="POST" action="newslaterEmail">
                            @csrf
                                <input type="email" name="email" placeholder="Your email">
                                <input type="submit" value="send">
                            </form><!-- .flex -->
                        </div><!-- .search-widget -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-widgets -->

        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by Flukyy. This website and its content may not be copied or reproduced under any circumstance.
</p>
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->

    <script type='text/javascript' src="{{ asset('landing/js/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/jquery.collapsible.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/swiper.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/jquery.countdown.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/circle-progress.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/jquery.countTo.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/jquery.barfiller.js') }}"></script>
    <script type='text/javascript' src="{{ asset('landing/js/custom.js') }}"></script>

</body>
</html>