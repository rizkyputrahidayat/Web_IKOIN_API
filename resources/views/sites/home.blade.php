@extends('layout.frontend')

@section('content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>	
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase">
                    IKOIN
                </h1>
                <p class="pt-10 pb-10" style="font-size: 18px">
                    WELCOME <br>
                    Your personal finacial package for those just learning about finances
                    IKOIN Bank can supply all your personal banking needs <br>
                    By utilizing the simplicity of coins from many complex services that most users have never used, we provide users with applications that are very intuitive but can be used fully to manage their finances.
                </p>
                <a href="/login" class="primary-btn text-uppercase">Login</a>
            </div>										
        </div>
    </div>					
</section>
<!-- End banner Area -->

<!-- Start feature Area -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Bank IKOIN</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. At, veniam.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Bank IKOIN</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. At, veniam.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature">
                    <div class="title">
                        <h4>Bank IKOIN</h4>
                    </div>
                    <div class="desc-wrap">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. At, veniam.
                        </p>
                        <a href="#">Join Now</a>									
                    </div>
                </div>
            </div>												
        </div>
    </div>	
</section>
<!-- End feature Area -->
        

<!-- Start upcoming-event Area -->
<section class="upcoming-event-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Upcoming Events IKOIN</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta suscipit aut est voluptatum, beatae harum.</p>
                </div>
            </div>
        </div>								
        <div class="row">
            <div class="active-upcoming-event-carusel">
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e2.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>	
                <div class="single-carusel row align-items-center">
                    <div class="col-12 col-md-6 thumb">
                        <img class="img-fluid" src="{{asset('/frontend')}}/img/e1.jpg" alt="">
                    </div>
                    <div class="detials col-12 col-md-6">
                        <p>25th February, 2018</p>
                        <a href="#"><h4>The Universe Through
                        A Child S Eyes</h4></a>
                        <p>
                            For most of us, the idea of astronomy is something we directly connect to “stargazing”, telescopes and seeing magnificent displays in the heavens.
                        </p>
                    </div>
                </div>																						
            </div>
        </div>
    </div>	
</section>  
@endsection