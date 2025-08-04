@extends('layouts.frontend')
@section('title', 'Order Success')
@section('content')
<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="#">Home |</a> Blog</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<section class="contact-area">
    <div class="text-center mt-5">
        <h2>🎉 Order Placed Successfully!</h2>
        <p>Thank you for your order. <a href="{{ route('shop') }}">Go to shop</a> <br>You can download your invoice below.</p>

        @if(session('invoice_download_path'))
        <a href="{{ route('download.invoice', ['filename' => session('invoice_download_path')]) }}"
            class="btn-two"
            download>
            ⬇️ Download Invoice
        </a>
        @endif

    </div>

    <!-- /.container-fluid end -->
</section>


@endsection