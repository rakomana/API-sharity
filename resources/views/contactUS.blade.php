@extends('layouts.nav')
@section('content')

</head>

	<!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Contact Us
                    </h1>
                    <p class="text-white"><a href="index.html">contact </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Contact Us</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
            <div class="col-lg-4 d-flex flex-column">
                <a class="contact-btns" href="#">Submit Your CV</a>
                <a class="contact-btns" href="#">Post New Job</a>
                <a class="contact-btns" href="#">Create New Account</a>
            </div>
            <div class="col-lg-8">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
               <div class="col-lg-12 form-group">
                {!! Form::open(['route'=>'contactus.store']) !!}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('Name:') !!}
                {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('Email:') !!}
                {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
                <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                {!! Form::label('Message:') !!}
                {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
                <span class="text-danger">{{ $errors->first('message') }}</span>
                </div>
                <div class="form-group">
                    <button class="primary-btn mt-20 text-black" style="float: right;">Send Message</button>
                    <div class="mt-20 alert-msg" style="text-align: left;"></div>
                </div>
                {!! Form::close() !!}
               </div>
            </div>
        </div>
    </div>
</section>
<!-- End contact-page Area -->

@endsection
