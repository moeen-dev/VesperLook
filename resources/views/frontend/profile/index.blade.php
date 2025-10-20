@extends('layouts.frontend')
@section('title', 'Profile')
@section('content')
<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Profile</p>
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

@php
$user = Auth::guard('user')->user();
@endphp

<section class="account-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-3">
                <div class="account-details">
                    @if($user->image)
                    <img
                        src="{{ url('upload/images/' . $user->image) }}"
                        class="rounded-circle border border-secondary shadow"
                        style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                    <p>{{ $user->name }}</p>
                    <ul>
                        <li><strong>Eamil:</strong> <br> {{ $user->email }}</li>
                        <!-- User Shipping Address -->
                        @if($user->shipping_address)
                        <li><strong>Shipping Address:</strong> <br> {{ $user->shipping_address }}</li>
                        @else
                        <li><strong>Shipping Address:</strong> <br> Null</li>
                        @endif
                        <!-- User Billing Address -->
                        @if($user->billing_address)
                        <li><strong>Billing Address:</strong> <br> {{ $user->billing_address }}</li>
                        @else
                        <li><strong>Billing Address:</strong> <br> Null</li>
                        @endif
                    </ul>
                    <a href="{{ route('user.profile.edit') }}" class="btn-2">Edit Profile</a>
                </div>
                <!-- /.cart-subtotal -->
            </div>
            <!-- /.col-xl-3 -->
            <div class="col-xl-9">
                <div class="account-table">
                    <h6>Order History</h6>
                    <table class="tables">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Payment Status </th>
                                <th>Fulfillment Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        @if($orders->count() > 0)
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('order.invoice', $order->id) }}" data-toggle="tooltip" title="Download Invoice">INV #{{ $order->id }}</a>
                                </td>
                                <td>
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>
                                <td>
                                    @if($order->payment_method === 'cod')
                                    COD
                                    @else($order->payment_method === 'bkash')
                                    Paid By Bkash
                                    @endif
                                </td>

                                <td>
                                    {{ $order->delivery_status }}
                                </td>
                                <td>
                                    {{ $order->total }}
                                </td>

                            </tr>
                            @endforeach
                            <!-- /.single product  -->
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <div style="text-align: right; margin-top: 15px;">
                    <a href="{{ route('user.logout') }}" class="btn-one">Log out</a>
                </div>
                <!-- /.cart-table -->
            </div>
            <!-- /.col-xl-9 -->

        </div>
    </div>
</section>
<!-- /.cart-area -->
@endsection