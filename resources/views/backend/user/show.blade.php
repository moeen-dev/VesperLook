@extends('layouts.backend')
@section('title', 'Users')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Users</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">User Details</h2>
            <p class="section-lead">User all details</p>

            <!--  -->
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @if($user->image)
                            <img alt="image" src="{{ url('upload/images', $user->image) }}" class="border rounded-circle profile-widget-picture">
                            @endif
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $user->name }}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> {{ $user->is_admin == 1 ? 'Admin' : 'User' }}
                                </div>
                            </div>
                            <!-- email -->
                            <b>Email: </b> {{ $user->email }}
                            <br>
                            <!-- verified -->
                            <b>Verified Status: </b>
                            @if($user->email_verified_at)
                            <span class="text-success"> Verified</span>
                            @else
                            <span class="text-danger"> Not Verified</span>
                            @endif
                            <br>
                            <!-- shipping address -->
                            <b>Shipping Address: </b>
                            @if($user->shipping_address)
                            <span> {{ $user->shipping_address }}</span>
                            @else
                            <span> No Shipping Address </span>
                            @endif
                            <br>
                            <b>Billing Address: </b>
                            <!-- billing address -->
                            @if($user->billing_address)
                            <span> {{ $user->billing_address }}</span>
                            @else
                            <span> No Billing Address </span>
                            @endif
                        </div>

                    </div>
                    <div>
                        <a href="javascript:history.back()" class="btn btn-primary">Return Back</a>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection