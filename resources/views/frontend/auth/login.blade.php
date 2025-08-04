@extends('layouts.frontend')
@section('title', 'Login')
@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Login</p>
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
            <h3>Login <span>Account</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                <div class="contact-form login-form">
                
                    <form action="{{ route('user.login.submit') }}" method="POST">
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
                                @error('password')
                                <div class="alert alert-danger mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="password" placeholder="Password*" name="password" id="password1" autocomplete="off">
                                <span class="pass-eye"><i class="fa fa-eye" id="togglePassword1"></i></span>
                            </div>
                            <div class="col-xl-12">
                                <input type="submit" value="LOG IN">
                            </div>
                            <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">
                            <div class="col-xl-12 mt-2">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <a href="{{ route('user.register') }}" class="btn-two">
                                        Create Account
                                    </a>
                                    <a href="{{ route('password.email') }}" class="btn-two">
                                        Reset Password
                                    </a>
                                </div>
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