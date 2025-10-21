@extends('layouts.frontend')
@section('title', 'About Us')
@section('content')

    <section class="breadcrumb-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bc-inner">
                        <p><a href="{{ route('home') }}">Home |</a> About Us</p>
                    </div>
                </div>
                <!-- /.col-xl-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <section class="contact-area">
        <div class="container-fluid custom-container">
            <div class="section-heading pb-30">
                <h3>About <span>us</span></h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    {!! $about->about_desc ?? '' !!}
                </div>
            </div>
            <!-- /.row end -->
        </div>
        <!-- /.container-fluid end -->
    </section>

@endsection
