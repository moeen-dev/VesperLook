@extends('layouts.backend');
@section('title', 'All Orders')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Order</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Order</h2>
            <p class="section-lead">All of your Order here</p>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <form action="{{ route('orders.index') }}" method="GET" class="form-inline float-right">
                                <select name="delivery_status" class="form-control" onchange="this.form.submit()">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('delivery_status')=='pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="processing" {{ request('delivery_status')=='processing' ? 'selected'
                                        : '' }}>Processing</option>
                                    <option value="shipped" {{ request('delivery_status')=='shipped' ? 'selected' : ''
                                        }}>Shipped</option>
                                    <option value="delivered" {{ request('delivery_status')=='delivered' ? 'selected'
                                        : '' }}>Delivered</option>
                                    <option value="canceled" {{ request('delivery_status')=='canceled' ? 'selected' : ''
                                        }}>Canceled</option>
                                </select>

                            </form>

                            <form action="{{ route('orders.index') }}" method="GET" class="form-inline float-right">
                                <input type="text" name="search" class="form-control mr-2"
                                    placeholder="Search by Order ID" value="{{ request('search') }}" required>
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Shipping Cost</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($orders->count() > 0)
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                                @switch($order->delivery_status)
                                                @case('pending')
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-clock mr-1"></i> Pending
                                                </span>
                                                @break

                                                @case('processing')
                                                <span class="badge badge-info">
                                                    <i class="fas fa-spinner mr-1"></i> Processing
                                                </span>
                                                @break

                                                @case('shipped')
                                                <span class="badge badge-primary">
                                                    <i class="fas fa-truck mr-1"></i> Shipped
                                                </span>
                                                @break

                                                @case('delivered')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i> Delivered
                                                </span>
                                                @break

                                                @case('canceled')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle mr-1"></i> Canceled
                                                </span>
                                                @break

                                                @default
                                                <span class="badge badge-dark">Unknown</span>
                                                @endswitch
                                            </td>
                                            <td>{{ $order->total }}</td>
                                            <td>
                                                @if($order->delivery_status != 'delivered')
                                                @switch($order->payment_method)
                                                @case('cod')
                                                <span class="badge badge-warning">Cash On Delivery</span>
                                                @break

                                                @case('bkash')
                                                <span class="badge badge-success">Paid By Bkash</span>
                                                @break

                                                @case('nagad')
                                                <span class="badge badge-success">Paid By Nagad</span>
                                                @break

                                                @default
                                                {{ ucfirst($order->payment_method) }}
                                                @endswitch
                                                @else
                                                <span class="badge badge-success">Paid COD</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->shipping_cost }}</td>
                                            <td>{{ $order->created_at->format('F d, Y') }}</td>
                                            <td class="d-flex justify-content-center align-items-center"
                                                style="gap: 10px;">
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info"
                                                    data-toggle="tooltip" title="Order Details"><i
                                                        class="far fa-edit"></i> Details</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9" class="text-center text-danger">
                                                <p>No Data Found!</p>
                                                <a href="{{ route('orders.index')}}" class="btn btn-primary">All
                                                    Order</a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection