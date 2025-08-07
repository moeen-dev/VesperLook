@extends('layouts.frontend')
@section('title', 'Contact')
@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Contact</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->



<!--Contact area
	============================================= -->
<section class="contact-area">
    <div class="container-fluid custom-container">
        <div class="section-heading pb-30">
            <h3>Contact with <span>us</span></h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 col-xl-6">
                <div class="contact-form">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <input type="text" value="{{ old('name', $user->name ?? '') }}" name="name" id="name"
                                    placeholder="First Name*" required class="@error('name') is-invalid @enderror">
                            </div>
                            <div class="col-xl-6">
                                <input type="email" value="{{ old('email', $user->email ?? '') }}" name="email"
                                    id="email" placeholder="Email Address*" required
                                    class="@error('email') is-invalid @enderror">
                            </div>
                            <div class="col-xl-6">
                                <input type="text" value="{{ old('phone_number', $user->phone_number ?? '') }}"
                                    name="phone_number" id="phone_number" placeholder="Phone Number*" required
                                    class="@error('phone_number') is-invalid @enderror">
                            </div>
                            <div class="col-xl-12">
                                <input type="text" value="{{ old('subject', $user->subject ?? '') }}" name="subject"
                                    id="subject" placeholder="Your Subject*" required
                                    class="@error('subject') is-invalid @enderror">
                            </div>
                            <div class="col-xl-12">
                                <textarea name="message" id="message" placeholder="Message"
                                    class="@error('message') is-invalid @enderror">{{ old('message', $user->message ?? '') }}</textarea>
                            </div>

                            <div class="col-xl-12">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                        <label for="captcha">What is <span class="text-danger">{{ $num1 }} + {{ $num2 }}
                                                = ?</span></label>
                                        <input type="text" name="captcha" id="captcha" placeholder="Answer*" required
                                            class="@error('captcha') is-invalid @enderror">
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 text-end">
                                        <input type="submit" value="SUBMIT" style="width: 100%;">
                                    </div>
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

<!-- Map area
	============================================= -->

<!-- <section class="google-map"> -->
<!-- <div class="row no-gutters"> -->
<!-- <div class="col-md-6 col-lg-6"> -->
<!-- <div class="gmap3-area" data-lat="40.730260" data-lng="-74.040315" data-mrkr="{{ url('assets/frontend/media/images/icon/map-marker.png') }}"></div> -->
<!-- /.google-map -->
<!-- </div> -->
<!-- /.col-xl-6 -->
<!-- <div class="col-md-6 col-lg-6"> -->
<!-- <div class="contact-info"> -->
<!-- <h5>ThemeIM Park</h5> -->
<!-- <span>garmany</span> -->
<!-- <p>Queens stae park city, Momin Tower 78, New York,WT47.</p> -->
<!-- <p>Monday - Sunday:<span> 9:00am - 7:15pm</span> </p> -->
<!-- <p>Phone:<span> 022 1458 645 125</span></p> -->
<!-- </div> -->
<!-- </div> -->
<!-- /.col-xl-6 -->
<!-- </div> -->
<!-- /.row -->
<!-- </section> -->
<!-- /#map -->


<!--Shop area
	============================================= -->
<section class="store-area padding-120">
    <div class="container">
        <div class="section-heading  pb-30">
            <h3>SHOP ALSO <span>HERE</span></h3>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="single-store">
                    <img src="{{ url('assets/frontend/media/images/banner/cf1.jpg') }}" alt="">
                    <a href="#">paris fashion city</a>
                    <p>france</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-store">
                    <img src="{{ url('assets/frontend/media/images/banner/cf2.jpg') }}" alt="">
                    <a href="#">fashion world</a>
                    <p>new zealand</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-store">
                    <img src="{{ url('assets/frontend/media/images/banner/cf3.jpg') }}" alt="">
                    <a href="#">ThemeIM Park</a>
                    <p>manhattan</p>
                </div>
            </div>
        </div>
        <!-- /.row end -->
    </div>
    <!-- /.container-fluid end -->
</section>
<!-- /.contact-area end -->

@endsection
@section('scripts')
<script>
    window.toastMessages = {
        @if (session('success'))
            success: @json(session('success')),
        @endif
        @if (session('error'))
            error: @json(session('error')),
        @endif
        @if (session('info'))
            info: @json(session('info')),
        @endif
        @if (session('warning'))
            warning: @json(session('warning')),
        @endif
        @if ($errors->any())
            validationErrors: @json($errors->all()), // show first validation error
        @endif
    };
</script>
@endsection