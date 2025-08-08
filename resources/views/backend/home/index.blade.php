@extends('layouts.backend')
@section('title', 'Home')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Order Statistics</div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $counts['pending'] ?? 0 }}</div>
                                <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $counts['processing'] ?? 0 }}</div>
                                <div class="card-stats-item-label">Processing</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $counts['shipped'] ?? 0 }}</div>
                                <div class="card-stats-item-label">Shipped</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count">{{ $counts['delivered'] ?? 0 }}</div>
                                <div class="card-stats-item-label">Delivered</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <!-- Total Orders -->
                        <div class="d-flex align-items-center">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h5 class="mb-1">Total Orders</h5>
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-0">{{ $totalOrders ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Total Canceled -->
                        <div class="d-flex align-items-center">
                            <div class="card-icon shadow-danger bg-danger">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h5 class="mb-1">Total Canceled</h5>
                                </div>
                                <div class="card-body">
                                    <h4 class="mb-0">{{ $totalCanceled ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="d-flex flex-column gap-4">
                        <!-- Total Selling Amount -->
                        <div class="d-flex align-items-center">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Selling Amount</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalAmount ?? 0}}
                                </div>
                            </div>
                        </div>

                        <!-- Total Due Amount -->
                        <div class="d-flex align-items-center">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Due Amount</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalDue ?? 0}}.00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalAdmins ?? 0}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-stream"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Categories</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSubCategories ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fab fa-product-hunt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Products In Stock</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalProducts ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Online Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsers ?? 0}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Statistics</h4>
                        {{-- <div class="card-header-action">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary">Week</a>
                                <a href="#" class="btn">Month</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="182"></canvas>
                        <div class="statistic-details mt-sm-4">
                            <div class="statistic-details-item">
                                <span class="text-muted">
                                    <span class="{{ $todaysSalesChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                        <i class="fas fa-caret-{{ $todaysSalesChange >= 0 ? 'up' : 'down' }}"></i>
                                    </span>
                                    {{ round($todaysSalesChange, 1) }}%
                                </span>
                                <div class="detail-value">${{ number_format($todaysSales, 2) }}</div>
                                <div class="detail-name">Today's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted">
                                    <span class="{{ $thisWeeksSalesChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                        <i class="fas fa-caret-{{ $thisWeeksSalesChange >= 0 ? 'up' : 'down' }}"></i>
                                    </span>
                                    {{ round($thisWeeksSalesChange, 1) }}%
                                </span>
                                <div class="detail-value">${{ number_format($thisWeeksSales, 2) }}</div>
                                <div class="detail-name">This Week's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted">
                                    <span class="{{ $thisMonthsSalesChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                        <i class="fas fa-caret-{{ $thisMonthsSalesChange >= 0 ? 'up' : 'down' }}"></i>
                                    </span>
                                    {{ round($thisMonthsSalesChange, 1) }}%
                                </span>
                                <div class="detail-value">${{ number_format($thisMonthsSales, 2) }}</div>
                                <div class="detail-name">This Month's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                                <span class="text-muted">
                                    <span class="{{ $thisYearsSalesChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                        <i class="fas fa-caret-{{ $thisYearsSalesChange >= 0 ? 'up' : 'down' }}"></i>
                                    </span>
                                    {{ round($thisYearsSalesChange, 1) }}%
                                </span>
                                <div class="detail-value">${{ number_format($thisYearsSales, 2) }}</div>
                                <div class="detail-name">This Year's Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Orders</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($orders as $order)
                            <li class="media">
                                @if($order->user->image)
                                <img class="mr-3 rounded-circle" width="50"
                                    src="{{ url('upload/images', $order->user->image ) }}"
                                    alt="{{ $order->user->name }}_profile_image">
                                @else
                                <img class="mr-3 rounded-circle" width="50"
                                    src="{{ url('assets/backend/assets/img/avatar/avatar-1.png') }}"
                                    alt="{{ $order->user->name}}_no_image">
                                @endif
                                <div class="media-body">
                                    <div class="float-right text-primary">{{ $order->created_at->diffForHumans() }}
                                    </div>
                                    <div class="media-title">{{ $order->name }}</div>
                                    <span class="text-small text-muted">{{ $order->order_note ?? 'No Order Note
                                        given!'}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @if($orders->count() > 8)
                        <div class="text-center pt-1 pb-1">
                            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg btn-round">
                                View All
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
{{-- Script for Chart --}}
@section('scripts')
<script>
    window.chartLabels = @json($weekDays);
    window.chartData = @json($dailySales);
</script>
@endsection