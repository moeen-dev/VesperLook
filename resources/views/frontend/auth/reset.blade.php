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
            <h3>Enter New <span>Password</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                <div class="contact-form login-form">
                    
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="col-xl-12">
                                <input type="email" placeholder="Email*" name="email" id="email" autocomplete="off" value="{{ $email ?? old('email') }}">
                            </div>

                            <div class="col-xl-12">
                                <input type="password" placeholder="Password*" name="password" id="password1" required autocomplete="new-password"
                                    class="@error('password') is-invalid @enderror">
                                <span class="pass-eye"><i class="fa fa-eye" id="togglePassword1"></i></span>

                                @error('password')
                                <div class="alert alert-primary mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <input type="password" placeholder="Confirm Password*" name="password_confirmation" id="password2" required autocomplete="new-password"
                                    class="@error('password_confirmation') is-invalid @enderror">
                                <span class="pass-eye"><i class="fa fa-eye" id="togglePassword2"></i></span>

                                @error('password_confirmation')
                                <div class="alert alert-primary mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="col-xl-12">
                                <input type="submit" value="Reset Password">
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


@endsection