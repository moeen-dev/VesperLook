@extends('layouts.frontend')
@section('title', 'Edit')
@section('content')<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Edit Your Profile</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!-- ====================== -->
<!-- = Edit Profile Form     = -->
<!-- ====================== -->
<section class="contact-area">
    <div class="container-fluid custom-container">
        <div class="section-heading pb-30">
            <h3>Edit Your <span>Account</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                <div class="contact-form login-form">

                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                @error('image')
                                <div class="alert alert-danger mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="file" class="form-image" name="image" id="image" data-default-file="{{ $user->image ? url('upload/images', $user->image) : '' }}" style="height: 300px; width: 300px;">
                            </div>

                            <div class="col-xl-12">
                                @error('name')
                                <div class="alert alert-danger mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" placeholder="Your Name*" name="name" id="name" autocomplete="off" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-xl-12">
                                @error('email')
                                <div class="alert alert-danger mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="email" placeholder="Eamil*" name="email" id="email" autocomplete="off" value="{{ old('email', $user->email) }}" disabled>
                                <input type="hidden" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="col-xl-12">
                                <input type="password" placeholder="Password*" name="password" id="password1" autocomplete="new-password"
                                    class="@error('password') is-invalid @enderror">
                                <span class="pass-eye"><i class="fa fa-eye" id="togglePassword1"></i></span>

                                @error('password')
                                <div class="alert alert-primary mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <input type="password" placeholder="Confirm Password*" name="password_confirmation" id="password2" autocomplete="new-password"
                                    class="@error('password_confirmation') is-invalid @enderror">
                                <span class="pass-eye"><i class="fa fa-eye" id="togglePassword2"></i></span>

                                @error('password_confirmation')
                                <div class="alert alert-primary mt-2 mb-0 py-1 px-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <input type="text" placeholder="Shipping Address*" name="shipping_address" id="shipping_address" autocomplete="off" value="{{ old('shipping_address', $user->shipping_address) }}">
                            </div>
                            <div class="col-xl-12">
                                <input type="text" placeholder="Billing Address*" name="billing_address" id="billing_address" autocomplete="off" value="{{ old('billing_address', $user->billing_address) }}">
                            </div>
                            <div class="col-xl-12">
                                <input type="submit" value="Update">
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
            <span>Already have account?</span>
            <a href="{{ route('user.login') }}" class="btn-two">Login now</a>
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.login-now -->

@endsection