@extends('layouts.frontend')
@section('title', 'Verify Email')
@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Verification</p>
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
            <h3>Enter Your <span>Code</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                <div class="contact-form login-form">
                    
                    <form action="{{ route('user.verify.code.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                @error('code')
                                <div class="alert alert-danger mb-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" placeholder="Enter Verification Code" name="code" id="code" autocomplete="off" maxlength="6" required>
                            </div>
                            <div class="col-xl-12">
                                <input type="submit" value="VERIFY">
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