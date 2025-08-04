@extends('layouts.backend')
@section('title', 'Add Coupon')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Add a Coupon</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Add a Coupon</h2>
            <p class="section-lead">Create your Coupon from here</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fill this form and Click on Save.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('coupon.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <!-- Coupon Code -->
                                <div class="form-group row mb-4">
                                    <label for="code" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Coupon Code</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
                                        @if($errors->has('code'))
                                        <small class="text-danger">{{ $errors->first('code') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Minimum Order Amount -->
                                <div class="form-group row mb-4">
                                    <label for="min_order_amount" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Minimum Order Amount</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" step="0.01" name="min_order_amount" id="min_order_amount" class="form-control" value="{{ old('min_order_amount') }}" required>
                                        @if($errors->has('min_order_amount'))
                                        <small class="text-danger">{{ $errors->first('min_order_amount') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Discount Percent -->
                                <div class="form-group row mb-4">
                                    <label for="discount_percent" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Discount Percent</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" step="0.01" min="0" max="100" name="discount_percent" id="discount_percent" class="form-control" value="{{ old('discount_percent') }}" required>
                                        @if($errors->has('discount_percent'))
                                        <small class="text-danger">{{ $errors->first('discount_percent') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Expiration Date -->
                                <div class="form-group row mb-4">
                                    <label for="expires_at" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Expiration Date</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="datetime-local" name="expires_at" id="expires_at" class="form-control" value="{{ old('expires_at') }}" required>
                                        @if($errors->has('expires_at'))
                                        <small class="text-danger">{{ $errors->first('expires_at') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group row mb-4">
                                    <div class="col-sm-12 col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
    $("#category_name").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
        $("#slug").val(Text);
    });
</script>
@endsection