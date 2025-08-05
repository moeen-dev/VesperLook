@extends('layouts.backend')
@section('title', 'Discount Coupon')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Discount Coupon</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Discount Coupon</h2>
            <p class="section-lead">All of your Discount Coupon here</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('coupon.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Coupon</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Coupon Name</th>
                                            <th scope="col">Minimum Order</th>
                                            <th scope="col">DisCount</th>
                                            <th scope="col">Expiry Time</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($discounts->count() > 0)
                                        @foreach($discounts as $discount)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $discount->code }}</td>
                                            <td>{{ $discount->min_order_amount }}</td>
                                            <td>{{ $discount->discount_percent }}</td>
                                            <td>
                                                @if (\Carbon\Carbon::parse($discount->expires_at)->isPast())
                                                <span class="badge badge-danger">Expired ❌</span>
                                                @else
                                                <span class="badge badge-success">Valid ✔️</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                                                <form action="{{ route('coupon.destroy', $discount->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" title="Delete this Coupon" class="btn btn-danger" type="submit" onclick="return confirm('Do you want to delete it?')"><i class="fas fa-times"></i> Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center text-danger">
                                                <p>No Data Found!</p>
                                                <a href="{{ route('coupon.create')}}" class="btn btn-primary">Create a new one</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $discounts->withQueryString()->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection