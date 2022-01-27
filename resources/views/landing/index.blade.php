@extends('landing.layout.master')
@section('title')
    Flukyy Get a Chance to Earn $1000
@endsection
@section('hero')
<div class="home-page-welcome">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 order-2 order-lg-1">
                <div class="welcome-content">
                    <header class="entry-header">
                        <h2 class="entry-title">Earn $1000 By Chance Than Skills...</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content mt-5 text-white">
                        <p>Vote & Get a Chance to Earn $100 Free, Refer to Earn..</p>
                        <p>Flukyy provide an equal opportunity to everyone to earn $100 free by submitting a vote in Fluke.</p>
                        <p>Earn Flukyy coins free from a Physical Product (Scratch Card), by Watching promotion website, Gift Cards, Discount Cards...</p>
                    </div><!-- .entry-content -->

                    <div class="entry-footer mt-5">
                        <a href="{{ route('register') }}" class="btn gradient-bg m-2">Open an Account</a>
                        <a href="{{ route('login') }}" class="btn gradient-bg m-2">Sign in</a>
                    </div><!-- .entry-footer -->
                </div><!-- .welcome-content -->
            </div><!-- .col -->

            <div class="col-12 col-lg-4 mt-4 order-1 order-lg-2">
                <!-- <img src="images/howto.jpg" alt="welcome"> -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
@endsection
@section('boxes-icon')
    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="images/hands-gray.png" alt="">
                            <img src="images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">OUR PRODUCTS</h3>
                        </header>

                        <div class="entry-content">
                            <p>Get a free card inside of pack!</p>
                            <p>Scratch to see Sorry try again! or a redeem code.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/donation-gray.png" alt="">
                            <img src="images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">GIFT CARDS</h3>
                        </header>

                        <div class="entry-content">
                            <p>Send free gift cards to your!</p>
                            <p>Lovers, Friends, Family, Followers, Youtube Subscribers etc.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/charity-gray.png" alt="">
                            <img src="images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">DISCOUNT CARDS</h3>
                        </header>

                        <div class="entry-content">
                            <p>Give free discount cards to customers!</p>
                            <p>Let your customers earn by chance & say Thanks for shopping with you.</p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/hands-gray.png" alt="">
                            <img src="images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">VOTE</h3>
                        </header>

                        <div class="entry-content">
                            <p>Vote and earn $100!</p>
                            <p>Voting page will appear to everyone after enrollments are closed in fluke.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="images/donation-gray.png" alt="">
                            <img src="images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">FLUKE</h3>
                        </header>

                        <div class="entry-content">
                            <p>Enroll in Fluke and earn $1000!</p>
                            <p>Earn free flukyy coins and enroll in fluke with 40 coins.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/charity-gray.png" alt="">
                            <img src="images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">REFER!</h3>
                        </header>

                        <div class="entry-content">
                            <p>Refer and earn $50!</p>
                            <p>You will earn $50 commission when your referral earn in fluke.</p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
    <div class="home-page-icon-boxes">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/hands-gray.png" alt="">
                            <img src="images/hands-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">NEW PRODUCT</h3>
                        </header>

                        <div class="entry-content">
                            <p>Launch new product with us!</p>
                            <p>Contact customer service and share your idea for a physical product.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <figure class="d-flex justify-content-center">
                            <img src="images/donation-gray.png" alt="">
                            <img src="images/donation-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">PROMOTION</h3>
                        </header>

                        <div class="entry-content">
                            <p>Promote your website!</p>
                            <p>Reach more potential customers, viewers, and buyers on our plateform.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box active">
                        <figure class="d-flex justify-content-center">
                            <img src="images/charity-gray.png" alt="">
                            <img src="images/charity-white.png" alt="">
                        </figure>

                        <header class="entry-header">
                            <h3 class="entry-title">EARN FREE!</h3>
                        </header>

                        <div class="entry-content">
                            <p>Earn free flukyy coins!</p>
                            <p>Go to earn free page and earn free coins to get enroll in fluke.</p>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
    <div class="help-us">
    <div class="container">
        <div class="row index-page-table">
            <h3 class="text-white mb-5">Latest Fluke Enrollments</h3>
            {{-- <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Amount Token</th>
                    <th scope="col">Fluke ID</th>
                    <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                @php
                $detailUsers = DB::table('enrollments')->limit(5)->latest()->get();
                @endphp
                  
                </tbody>
                </table> --}}
        </div>
    </div>
</div>
@endsection
@section('howto')
<div class="home-page-welcome">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 order-2 order-lg-1">
                <div class="welcome-content">
                    <header class="entry-header">
                        <h2 class="entry-title">How Our System Work</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content mt-5 text-justify">
                        <p>Users earn free coins, enroll in Fluke with 40 coins & download their secure file, After 5000 enrollments voting page will be open to everyone for 5000 votes where you can cast a vote without any coins and download secure file. All votes will be submitted to earning table, The topper who gets most votes will earn automatically. Users who have enrolled in fluke can vote but their vote will not be deducted from the counting of 5000 votes. You will receive a password in your registered mail box to open your secure file when fluke ends. Subscribe us on YouTube and click to watch a short video...</p>
                    </div><!-- .entry-content -->

                    <div class="entry-footer mt-5">
                        <a href="{{ route('register') }}" class="btn gradient-bg mr-2">Open an Account</a>
                    </div><!-- .entry-footer -->
                </div><!-- .welcome-content -->
            </div><!-- .col -->

            <div class="col-12 col-lg-6 mt-4 order-1 order-lg-2">
                <!-- <img src="images/howto.jpg" alt="welcome"> -->
                <div class="iframe-container"> 
                    <iframe class="responsive-iframe" src="https://www.youtube.com/embed/4FqeCU5b9b8"></iframe>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .home-page-icon-boxes -->
@endsection
@section('finaldesc')
<div class="help-us">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                <h2>Register New Account Today!</h2>

                <a class="btn orange-border" href="{{ route('register') }}">Register Now</a>
            </div>
        </div>
    </div>
</div>
@endsection