@extends('layout.frontend')

@section('content')
<section class="banner-area relative" style="background: unset;" id="home">
    <div class="overlay overlay-bg"></div>	
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Register		
                </h1>
                <p class="text-white link-nav"><a href="/">Home</a><span class="lnr lnr-arrow-right"></span>
                    <a href="/about">Pendafataran</a>
                    
                </p>
            </div>										
        </div>
    </div>					
</section>
<section class="search-course-area relative" style="background: unset;">
    <div class="overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-4 col-md-6 search-course-left">
                <h1>
                    Pendaftaran Online Nasabah IKOIN <br>
                    Bergabung Bersama Kami
                </h1>
                <p>
                    inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
                </p>
            </div>
            <div class="col-lg-8 col-md-6 search-course-right section-gap">
                {!! Form::open(['url' => '/postregister','class' => 'form-wrap']) !!}
                    <h4 class="pb-20 text-center mb-30">Formulir Pendaftaran IKOIN</h4>	
                    {!!Form::text('nama','',['class' => 'form-control','placeholder' => 'Nama Lengkap']) !!}	
                    {!!Form::date('tgl_lahir','',['class' => 'form-control','placeholder' => '0000-00-00']) !!}
                    <div class="form-select" id="service-select">
                        {!!Form::select('jenis_kelamin', ['' => 'Jenis Kelamin','L' => 'Laki-Laki', 'P' => 'Perempuan'],'L');!!}
                    </div>	
                    {!!Form::text('nama_ibu','',['class' => 'form-control','placeholder' => 'Nama Ibu']) !!}
                    {!!Form::email('email','',['class' => 'form-control','placeholder' => 'Email']) !!}
                    {!!Form::text('username','',['class' => 'form-control','placeholder' => 'Username']) !!}
                    {!!Form::password('password',['class' => 'form-control','placeholder' => 'Password']) !!}
                    {!!Form::textarea('alamat','',['class' => 'form-control','placeholder' => 'Alamat']) !!}
                    <input type="submit" class="primary-btn text-uppercase" value="Kirim"></input>
                {!! Form::close() !!}
            </div>
        </div>
    </div>	
</section>
@endsection