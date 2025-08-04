@extends('layouts.frontend')
@section('title', 'Shop')
@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->

<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home </a> | {{ $product->title }}</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<section class="shop-area style-two">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <!-- Product View Slider -->
                        <div class="quickview-slider">
                            <div class="slider-for">
                                @if($product->image1)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image1) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image2)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image2) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image3)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image3) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image4)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image4) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                            </div>

                            <div class="slider-nav">

                                @if($product->image1)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image1) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image2)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image2) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image3)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image3) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                                @if($product->image4)
                                <div class="">
                                    <img src="{{ url('upload/images', $product->image4) }}" alt="{{ $product->title }}">
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.quickview-slider -->
                    </div>
                    <!-- /.col-xl-6 -->

                    <div class="col-lg-6 col-xl-6">
                        <div class="product-details">
                            <h5 class="pro-title"><a
                                    href="{{ route('shop.details', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug, 'productSlug' => $product->slug]) }}">{{
                                    $product->title }}</a></h5>
                            <div class="mb-2">
                                @if ($product->quantity > 0)
                                <span style="font-weight: 500; font-size: 13px;"
                                    class="badge badge-success text-white">In Stock</span>
                                @else
                                <span style="font-weight: 500; font-size: 13px;"
                                    class="badge badge-danger text-white">Out of Stock</span>
                                @endif

                                @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10) <span
                                    style="font-weight: 500; font-size: 13px;" class="badge badge-primary text-white">
                                    New</span>
                                    @endif

                                    @if ($product->quantity <= 10 && $product->quantity > 0)
                                        <span style="font-weight: 500;  font-size: 13px;"
                                            class="badge badge-info text-white">{{ $product->quantity }} left</span>
                                        @endif
                            </div>
                            <span class="price">Price : ${{ $product->price }}</span>

                            <form id="add-to-cart-form-{{ $product->id }}"
                                action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="size-variation">
                                    @if($product->sizes && count($product->sizes) > 0)
                                    <span>size : </span>
                                    <select name="size">
                                        @foreach($product->sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <span>size : No Size Available for this Product.</span>
                                    @endif
                                </div>

                                <div class="color-variation">
                                    @if (!empty($colors))
                                    <span>Color :</span>
                                    <ul>
                                        @foreach($colors as $color)
                                        <li>
                                            <label>
                                                <input type="radio" name="color" value="{{ $color }}" hidden>
                                                <i class="fas fa-circle" style="color: <?= $color; ?>;"></i>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>

                                    @if ($errors->has('color'))
                                    <span class="text-danger">{{ $errors->first('color') }}</span>
                                    @endif
                                    @else
                                    <span class="mb-3">Color: No Color Available for this Product.</span>
                                    @endif
                                </div>


                                <div class="add-tocart-wrap">
                                    <!--PRODUCT INCREASE BUTTON START-->
                                    <div class="cart-plus-minus-button">
                                        <input type="text" value="1" name="quantity" class="cart-plus-minus">
                                    </div>
                                    @if ($product->quantity > 0)
                                    <a href="javascript:void(0);" class="add-to-cart"
                                        onclick="document.getElementById('add-to-cart-form-{{ $product->id }}').submit();">
                                        <i class="flaticon-shopping-purse-icon"></i>
                                        Add Cart
                                    </a>
                                    @else
                                    <a href="#" class="add-to-cart disabled"><i
                                            class="flaticon-shopping-purse-icon"></i>Out of Stock</a>
                                    @endif

                                    <!-- <a href="#"><i class="flaticon-valentines-heart"></i></a> -->
                                </div>
                            </form>

                            <div class="mt-3">
                                <!-- SKU Section -->
                                <span>SKU: {{ $product->sku ?? 'N/A' }}</span>
                            </div>

                        </div>
                        <!-- /.product-details -->
                    </div>
                    <!-- /.col-xl-6 -->


                    <div class="col-xl-12">
                        <div class="product-des-tab">
                            <ul class="nav nav-tabs " role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">DESCRIPTION</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                        aria-controls="contact" aria-selected="false">REVIEWS ({{ $reviews->count()
                                        }})</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="prod-bottom-tab-sin description">
                                        <h5>Description</h5>
                                        <p>{!! $product->description !!}</p>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="prod-bottom-tab-sin">
                                        <h5>Average Rating: {{ number_format($averageRating, 1) }}/5.0 <i style="color: #d19e66" class="fas fa-star"></i></h5>
                                        <div class="product-review">
                                            @if($reviews->count() > 0)
                                            @foreach ($reviews as $review)
                                            <div class="reviwer">
                                                @if($review->user->image)
                                                <img style="width: 120px; height: 120px;"
                                                    src="{{ url('upload/images', $review->user->image) }}" alt="{{ $review->user->name }}">
                                                @else
                                                <img src="{{ url('assets/frontend/media/custom-image/vesper-look-comment-avatar.jpg') }}" alt="vesper-look-comment-avatar">
                                                @endif
                                                {{-- <img src="{{ url('assets/frontend/media/images/reviewer.png') }}"
                                                    alt=""> --}}
                                                <div class="review-details">
                                                    <span>Reviewed by: {{ $review->user->name }} - Published on {{
                                                        $review->created_at->format('F d, Y') }}</span>
                                                    <div class="rating">
                                                        <div class="rating">
                                                            <ul>
                                                                @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->rating)
                                                                    <li><a><i class="fas fa-star"></i></a></li>
                                                                    {{-- filled star --}}
                                                                    @else
                                                                    <li><a><i class="far fa-star"></i></a></li>
                                                                    {{-- empty star --}}
                                                                    @endif
                                                                    @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <p>No Reviews Found!</p>
                                            @endif

                                            @php
                                            $authUser = Auth::guard('user')->user();
                                            @endphp

                                            @if ($authUser)
                                            <div class="add-your-review">
                                                <h6>ADD A REVIEW</h6>
                                                <p>YOUR RATING* </p>
                                                <form action="{{ route('review.store', $product->id ) }}" method="POST">
                                                    @csrf
                                                    <div class="rating">
                                                        <ul class="star-rating">
                                                            @for ($i = 1; $i <= 5; $i++) <li class="star"
                                                                data-value="{{ $i }}"><i class="far fa-star"></i></li>
                                                                @endfor
                                                        </ul>
                                                        <input type="hidden" name="rating" id="rating-value" value="0">
                                                    </div>

                                                    <div class="raing-form">
                                                        <input type="text" name="user_name" id="user_name"
                                                            value="{{ $user->name }}" disabled>
                                                        <input type="text" name="user_email" id="user_email"
                                                            value="{{ $user->email }}" disabled>
                                                        @error('comment')
                                                        <div class="alert alert-danger mt-2 mb-0 py-1 px-2"
                                                            role="alert">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <textarea name="comment" id="comment"></textarea>
                                                        <input type="submit">
                                                    </div>
                                                </form>
                                            </div>
                                            @else
                                            <p class="alert alert-warning">You must <a class="text-black-50"
                                                    href="{{ route('user.login') }}">log in</a> to leave a review.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-xl-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.shop-area -->
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star-rating .star");
        const ratingInput = document.getElementById("rating-value");

        stars.forEach((star, index) => {
            star.addEventListener("click", () => {
                let selected = index + 1;
                ratingInput.value = selected;

                stars.forEach((s, i) => {
                    const icon = s.querySelector("i");
                    if (i < selected) {
                        icon.classList.remove("far");
                        icon.classList.add("fas");
                        s.classList.add("active");
                    } else {
                        icon.classList.remove("fas");
                        icon.classList.add("far");
                        s.classList.remove("active");
                    }
                });
            });
        });
    });
</script>
@endsection