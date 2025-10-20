@extends('layouts.frontend')
@section('title', 'Home')
@section('content')
<!--=========================-->
<!--=        Slider         =-->
<!--=========================-->
@if($banners->count() > 0)
<section class="slider-wrapper">
    <div class="slider-start slider-2 owl-carousel owl-theme">

        @foreach($banners as $banner)
        <div class="item">
            <img src="{{ url('upload/images', $banner->image) }}" alt="">
        </div>
        @endforeach

    </div>
</section>

<!-- Slides end -->

<!--=========================-->
<!--= Product banner style two  =-->
<!--=========================-->
@if($subCategories->count() > 0)
<section class="category-area padding-120">
    <div class="container-fluid custom-container">
        <div class="category-carousel owl-carousel owl-theme">
            @foreach($subCategories as $subCategory)
            <div class="sin-category">
                <img src="{{ url('upload/images', $subCategory->image ) }}" alt="">
                <div class="cat-name">
                    <a
                        href="{{ route('collection.show', ['categorySlug' => $subCategory->category->slug, 'subcategorySlug' => $subCategory->slug]) }}">
                        <h5>{{ $subCategory->subcategory_name }}</h5>
                        <h5>Colle<span>ction</span></h5>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- .row -->
    </div>
    <!-- .container-fluid -->
</section>
@endif
<!-- .category section-->
<!--=========================-->
<!--= Product banner style two  =-->
<!--=========================-->

@if($products->count() > 0 )
<section class="main-product">
    <div class="container container-two">
        <div class="section-heading">
            <h3>Latest <span>product</span></h3>
        </div>
        <!-- /.section-heading-->
        <div class="row">
            <div class="order-lg-2 col-lg-12 col-xl-12">

                <!-- /.shop-sorting-area -->
                <div class="shop-content shop-four-grid">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                @foreach($products->take(8) as $product)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="sin-product style-two {{ $product->quantity <= 0 ? 'muted' : '' }}">
                                        <div class="pro-img">
                                            <img src="{{ url('upload/images', $product->image1) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                        @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10) <span
                                            class="new-tag">NEW!</span>
                                            @endif
                                            @if($product->quantity > 0)
                                            <span class="is-stock">In Stock</span>
                                            @else
                                            <span class="is-out-stock">Out of Stock</span>
                                            @endif
                                            <div class="mid-wrapper">
                                                <h5 class="pro-title"><a
                                                        href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}">{{
                                                        $product->title }}</a></h5>
                                                <div class="color-variation">
                                                    <ul>
                                                        @if (!empty($product->colors) && is_array($product->colors))
                                                        @foreach ($product->colors as $color)
                                                        @if (!empty($color))
                                                        <li><i class="fas fa-circle" style="color: <?= $color; ?>;"></i>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <p>{{ $product->subCategory->subcategory_name }} / <span><strong>Price:
                                                        </strong>$ {{ $product->price }}</span></p>
                                            </div>
                                            <div class="icon-wrapper">
                                                <div class="pro-icon">
                                                    <ul>
                                                        <li>
                                                            <a class="trigger" href="#" data-id="{{ $product->id }}"
                                                                title="Quick View" role="button">
                                                                Quick View
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @if($product->quantity > 0)
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}"
                                                    class="btn-two w-100">Buy Now</a>
                                            </div>
                                            @else
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}"
                                                    class="btn-two disabled w-100">Buy Now</a>
                                            </div>
                                            @endif

                                    </div>
                                    <!-- /.sin-product -->
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="load-more-wrapper">
                        <a href="{{ route('shop') }}" class="btn-two">Go to Shop</a>
                    </div>
                    <!-- /.load-more-wrapper -->
                </div>
                <!-- /.shop-content -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container  -->
</section>
@endif
<!-- main-product -->

<!--=========================-->
<!--=        Feature Area      =-->
<!--=========================-->

<section class="feature-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <!-- Single Feature -->
            <div class="col-sm-6 col-xl-3">
                <div class="sin-feature">
                    <div class="inner-sin-feature">
                        <div class="icon">
                            <i class="flaticon-free-delivery"></i>
                        </div>
                        <div class="f-content">
                            <h6><a href="#">FREE SHIPPING</a></h6>
                            <p>Free shipping on all order</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Feature -->
            <div class="col-sm-6  col-xl-3">
                <div class="sin-feature">
                    <div class="inner-sin-feature">
                        <div class="icon">
                            <i class="flaticon-shopping-online-support"></i>
                        </div>
                        <div class="f-content">
                            <h6><a href="#">ONLINE SUPPORT</a></h6>
                            <p>Online support 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Feature -->
            <div class="col-sm-6  col-xl-3">
                <div class="sin-feature">
                    <div class="inner-sin-feature">
                        <div class="icon">
                            <i class="flaticon-return-of-investment"></i>
                        </div>
                        <div class="f-content">
                            <h6><a href="#">MONEY RETURN</a></h6>
                            <p>Back guarantee under 5 days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Feature -->
            <div class="col-sm-6  col-xl-3">
                <div class="sin-feature">
                    <div class="inner-sin-feature">
                        <div class="icon">
                            <i class="flaticon-sign"></i>
                        </div>
                        <div class="f-content">
                            <h6><a href="#">MEMBER DISCOUNT</a></h6>
                            <p>Onevery order over $150</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.feature-area -->

@if($products->count() > 0 )
<section class="main-product">
    <div class="container container-two">
        <div class="section-heading">
            <h3>Best Selling <span>product</span></h3>
        </div>
        <!-- /.section-heading-->
        <div class="row">
            <div class="order-lg-2 col-lg-12 col-xl-12">

                <!-- /.shop-sorting-area -->
                <div class="shop-content shop-four-grid">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                @foreach($bestSellers as $product)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="sin-product style-two {{ $product->quantity <= 0 ? 'muted' : '' }}">
                                        <div class="pro-img">
                                            <img src="{{ url('upload/images', $product->image1) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                        @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10) <span
                                            class="new-tag">NEW!</span>
                                            @endif
                                            @if($product->quantity > 0)
                                            <span class="is-stock">In Stock</span>
                                            @else
                                            <span class="is-out-stock">Out of Stock</span>
                                            @endif
                                            <div class="mid-wrapper">
                                                <h5 class="pro-title"><a
                                                        href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}">{{
                                                        $product->title }}</a></h5>
                                                <div class="color-variation">
                                                    <ul>
                                                        @if (!empty($product->colors) && is_array($product->colors))
                                                        @foreach ($product->colors as $color)
                                                        @if (!empty($color))
                                                        <li><i class="fas fa-circle" style="color: <?= $color; ?>;"></i>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <p>{{ $product->subCategory->subcategory_name }} / <span><strong>Price:
                                                        </strong>$ {{ $product->price }}</span></p>
                                            </div>
                                            <div class="icon-wrapper">
                                                <div class="pro-icon">
                                                    <ul>
                                                        <li>
                                                            <a class="trigger" href="#" data-id="{{ $product->id }}"
                                                                title="Quick View" role="button">
                                                                Quick View
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @if($product->quantity > 0)
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}"
                                                    class="btn-two w-100">Buy Now</a>
                                            </div>
                                            @else
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}"
                                                    class="btn-two disabled w-100">Buy Now</a>
                                            </div>
                                            @endif

                                    </div>
                                    <!-- /.sin-product -->
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.shop-content -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container  -->
</section>
@endif

<!--=========================-->
<!--=   Discount Countdown area      =-->
<!--=========================-->
@endif
<section class="add-area">
    <a href="#"><img src="{{ url('assets/frontend/media/images/banner/add.jpg') }}" alt=""></a>
</section>




<!--=========================-->
<!--=   Popup area      =-->
<!--=========================-->




<!-- Popup -->
@php
use App\Models\NewsletterSubscriber;
use Carbon\Carbon;

$hidePopupCookie = request()->cookie('hide_newsletter_popup');
$ip = request()->ip();
$alreadySubscribed = NewsletterSubscriber::where('ip_address', $ip)
->where('created_at', '>=', Carbon::now()->subDays(7))
->exists();
@endphp

@if (!$hidePopupCookie && !$alreadySubscribed)
@include('frontend.partials.newsletter')
@endif







@endsection