@extends('layouts.backend');
@section('title', 'Order Details')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Manage Order</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Order Details</h2>
            <p class="section-lead">Manage Order from here</p>

            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Go Order Index
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Item Image</th>
                                        <th>Item Name</th>
                                        <th>Item SKU</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <img alt="image" src="{{ url('upload/images', $item->image ) }}" class="rounded-circle" width="50">
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->product->sku }}</td>
                                        <td>
                                            @if(!empty($item->color))
                                            <span class="rounded-circle d-inline-block" style="background-color: <?= $item->color; ?>; width: 20px; height: 20px;"></span>
                                            @else
                                            <span class="text-muted">No Color!</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($item->size))
                                            <span>{{ $item->size }}</span>
                                            @else
                                            <span class="text-muted">No Size!</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->total_price }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" value="{{ $order->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Customer Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                        <input type="text" value="{{ $order->phone }}" class="form-control phone-number" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Customer Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                        <input type="email" value="{{ $order->email }}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Shipping Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <input type="email" value="{{ $order->shipping_address }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>Billing Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        <input type="email" value="{{ $order->billing_address }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        <input type="email" value="{{ $order->city }}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Order Note</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-sticky-note"></i>
                                        </div>
                                    </div>
                                    <input type="text" value="{{ $order->order_note ?? 'No note provided' }}" class="form-control" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payment & Shipping</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Subtotal</strong>
                                        <span>${{ number_format($order->subtotal, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Shipping Cost</strong>
                                        <span>${{ number_format($order->shipping_cost, 2) }}</span>
                                    </li>
                                    @if(!empty($order->discount))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Discount Amount</strong>
                                        <span>- ${{ number_format($order->discount, 2) }}</span>
                                    </li>
                                    @endif
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Total</strong>
                                        <span class="text-primary font-weight-bold">${{ number_format($order->total, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Payment Method</strong>
                                        <span class="badge badge-{{ $order->payment_method == 'cod' ? 'warning' : 'success' }}">
                                            {{ strtoupper($order->payment_method) }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="form-label">Delivery Status</label>
                                    <div class="selectgroup selectgroup-pills">
                                        @php
                                        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'canceled'];
                                        @endphp

                                        @foreach ($statuses as $status)
                                        <label class="selectgroup-item">
                                            <input type="radio" name="delivery_status" value="{{ $status }}" class="selectgroup-input"
                                                {{ (old('delivery_status', $order->delivery_status) == $status) ? 'checked' : '' }}>
                                            <span class="selectgroup-button text-capitalize">{{ $status }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check"></i> Update Shipping Status
                                    </button>

                                    <div>
                                        <small class="text-muted d-block">
                                            <i class="far fa-calendar-plus"></i> Created at: {{ $order->created_at->format('F d, Y') }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="far fa-calendar-check"></i> Updated at: {{ $order->updated_at->format('F d, Y') }}
                                        </small>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Go Order Index
                </a>
            </div>

        </div>
    </section>
</div>
@endsection