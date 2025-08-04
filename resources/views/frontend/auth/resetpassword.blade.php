@extends('layouts.frontend')
@section('title', 'Reset Password')
@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Reset Password</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!--=========================-->
<!--=        Login         =-->
<!--=========================-->



<!--Login  area
	============================================= -->

<section class="contact-area">
    <div class="container-fluid custom-container">
        <div class="section-heading pb-30">
            <h3>Reset <span>Password</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                <div class="contact-form login-form">
                    
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                @error('email')
                                <div class="alert alert-danger mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="email" placeholder="Email*" name="email" id="email" autocomplete="off">
                            </div>
                            <div class="col-xl-12">
                                <input type="submit" value="Send Link">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row end -->
    </div>
    <!-- /.container-fluid end -->
</section>
<!-- /.contact-area end -->

<section class="login-now">
    <div class="container-fluid custom-container">
        <div class="col-12">
            <span>Already have an Account?</span>
            <a href="{{ route('user.login') }}" class="btn-two">Sign In</a>
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.login-now -->

@endsection