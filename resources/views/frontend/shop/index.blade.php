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
                    <p><a href="{{ route('home') }}">Home |</a>
                        @if(Route::is('collection.*'))
                        Collection
                        @else
                        Shop
                        @endif
                    </p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!--=========================-->
<!--=        Shop area          =-->
<!--=========================-->

<section class="shop-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="order-2 order-lg-1 col-lg-3 col-xl-3">
                <div class=" shop-sidebar left-side">
                    <div class="sidebar-widget sidebar-search">
                        <input type="text" placeholder="Search Product....">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="sidebar-widget category-widget">
                        <h6>PRODUCT CATEGORIES</h6>
                        <ul>
                            @foreach($subCategories->take(12) as $subCategory)
                            <li><a href="{{ route('collection.show', ['categorySlug' => $subCategory->category->slug, 'subcategorySlug' => $subCategory->slug]) }}">{{ $subCategory->subcategory_name }} </a> <span>({{ $subCategory->products_count }})</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-widget product-widget">
                        <h6>BEST SELLERS</h6>

                        <div class="wid-pro">
                            <div class="sp-img">
                                <img src="{{ url('assets/frontend/media/images/product/sb3.jpg') }}" alt="">
                            </div>
                            <div class="small-pro-details">
                                <h5 class="title"><a href="#">Contrasting T-Shirt</a></h5>
                                <span>$60</span>
                                <span class="pre-price">$80</span>
                                <div class="rating">
                                    <ul>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="sidebar-widget advertise-img">
                        <a href="#" class="img">
                            <img src="{{ url('assets/frontend/media/images/banner/sb1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.col-xl-3 -->
            <div class="order-1 order-lg-2 col-lg-9 col-xl-9">
                <div class="shop-sorting-area row">
                    <div class="col-4 col-sm-4 col-md-6">
                        <ul class="nav nav-tabs shop-btn" id="myTab" role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="flaticon-menu"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="flaticon-list"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-->
                    @if(Route::is('shop'))
                    <div class="col-12 col-sm-8 col-md-6">
                        <div class="sort-by">
                            <form method="GET" action="{{ request()->url() }}">
                                <span>Sort by :</span>
                                <select class="orderby" name="sort" onchange="this.form.submit()">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="category_men" {{ request('sort') == 'category_men' ? 'selected' : '' }}>Men Category</option>
                                    <option value="category_women" {{ request('sort') == 'category_women' ? 'selected' : '' }}>Women Category</option>
                                    <option value="category_kid" {{ request('sort') == 'category_kid' ? 'selected' : '' }}>Kids Category</option>
                                    <option value="category_accessories" {{ request('sort') == 'category_accessories' ? 'selected' : '' }}>Accessories Category</option>
                                    <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Product</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Product</option>
                                </select>

                                <!-- Preserve Pagination -->
                                @foreach(request()->except('sort', 'page') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="col-12 col-sm-8 col-md-6">
                        <div class="sort-by">
                            <form method="GET" action="{{ request()->url() }}">
                                <span>Sort by :</span>
                                <select class="orderby" name="sort" onchange="this.form.submit()">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Product</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Product</option>
                                </select>

                                <!-- Preserve Pagination -->
                                @foreach(request()->except('sort') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                            </form>
                        </div>
                    </div>
                    @endif

                    <!-- /.col-->
                </div>
                <!-- /.shop-sorting-area -->
                @if($products->count() > 0)
                <div class="shop-content">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-sm-6 col-xl-4">
                                    <div class="sin-product style-two">
                                        <div class="pro-img">
                                            <img src="{{ url('upload/images', $product->image1) }}" alt="{{ $product->title }}">
                                        </div>
                                        <div>
                                            @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10)
                                                <span class="new-tag">NEW!</span>
                                                @endif
                                        </div>
                                        <div class="mid-wrapper">
                                            <h5 class="pro-title"><a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}">{{ $product->title }}</a></h5>
                                            <div class="color-variation">
                                                <ul>
                                                    @if (!empty($product->colors) && is_array($product->colors))
                                                    @foreach ($product->colors as $color)
                                                    @if (!empty($color))
                                                    <li><i class="fas fa-circle" style="color: <?= $color; ?>;"></i></li>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <p class="d-flex justify-content-between mt-3">
                                                <span><strong>Price:</strong> ${{ $product->price }}</span>
                                                @if($product->quantity > 0)
                                                <span class="badge bg-secondary ms-2 small text-white ml-5">In Stock</span>
                                                @else
                                                <span class="badge bg-danger ms-2 small text-white ml-3">Out of Stock</span>
                                                @endif
                                            </p>
                                            @if($product->quantity > 0)
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}" class="btn-two w-100">Buy Now</a>
                                            </div>
                                            @else
                                            <div>
                                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}" class="btn-two disabled w-100">Buy Now</a>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="icon-wrapper">
                                            <div class="pro-icon">
                                                <ul>
                                                    {{-- <li><a href="#"><i class="flaticon-valentines-heart"></i></a></li> --}}
                                                    <li>
                                                        <a class="trigger" href="#" data-id="{{ $product->id }}" title="Quick View" role="button">
                                                            {{-- <i class="flaticon-eye"></i> --}}Quick View
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="add-to-cart">
                                                <!-- <a href="#">add to cart</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.sin-product -->
                                </div>
                                <!-- /.col- -->
                                @endforeach
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.tab-pane-->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    @foreach($products as $product)
                                    <div class="sin-product list-pro">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-6 col-xl-4">
                                                <div class="pro-img">
                                                    <img src="{{ url('upload/images', $product->image1 ) }}" alt="{{ $product->title }}">
                                                </div>

                                                <div>
                                                    @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10)
                                                        <span class="new-tag">NEW!</span>
                                                        @endif
                                                </div>
                                                <div class="pro-icon">
                                                    <ul>
                                                        {{-- <li><a href="#"><i class="flaticon-valentines-heart"></i></a></li> --}}
                                                        <li>
                                                            <a class="trigger" href="#" data-id="{{ $product->id }}" title="Quick View" role="button">
                                                                {{-- <i class="flaticon-eye"></i> --}}Quick View
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-lg-6 col-xl-8">
                                                <div class="list-pro-det">
                                                    <h5 class="pro-title">
                                                        <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                                        @if($product->quantity > 0)
                                                        <span style="font-size: 12px;" class="badge bg-secondary ms-2 small text-white ml-5">In Stock</span>
                                                        @else
                                                        <span style="font-size: 12px;" class="badge bg-danger ms-2 small text-white ml-3">Out of Stock</span>
                                                        @endif
                                                    </h5>
                                                    <span>$387</span>
                                                    <!-- <div class="rating">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        </ul>
                                                    </div> -->
                                                    <div class="color-variation">
                                                        <ul>
                                                            @if (!empty($product->colors) && is_array($product->colors))
                                                            @foreach ($product->colors as $color)
                                                            @if (!empty($color))
                                                            <li><i class="fas fa-circle" style="color: <?= $color; ?>;"></i></li>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <p>{!! Str::limit(strip_tags($product->description), 250) !!}</p>
                                                    <a class="btn-two" href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}">More Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.col- -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.tab-pane-->
                    </div>
                    <!-- /.tab-content -->
                    <!-- load more wrapper -->
                    <div class="load-more-wrapper">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination d-flex justify-content-center">
                                <!-- Previous Page Link -->
                                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}&sort={{ request('sort') }}">Previous</a>
                                </li>

                                <!-- Pagination Links -->
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->url($i) }}&sort={{ request('sort') }}">{{ $i }}</a>
                                    </li>
                                    @endfor

                                    <!-- Next Page Link -->
                                    <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}&sort={{ request('sort') }}">Next</a>
                                    </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /.load-more-wrapper -->

                </div>
                @else
                <div class="no-products-wrapper text-center mt-5">
                    <div class="no-products-content p-4 border rounded shadow-lg bg-light">
                        <h2 class="text-danger mb-3 display-3">Oops!</h2>
                        <p class="lead text-muted mb-4">It seems we couldn't find any products in this category.</p>
                        <i class="fas fa-box-open fa-3x text-primary mb-4"></i>
                        @if(Route::is('collection.*'))
                        <p class="mb-4">Try adjusting your filters, or go back to the collection to explore more categories!</p>
                        <a href="{{ route('collection') }}" class="btn-one">Go to Collection</a>
                        @else
                        <p class="mb-4">Try adjusting your filters, or go back to the shop to explore more products!</p>
                        <a href="{{ route('shop') }}" class="btn-one">Go to Shop</a>
                        @endif
                    </div>
                </div>
                @endif

                <!-- /.shop-content -->
            </div>
            <!-- /.col- -->
        </div>

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.shop-area -->
@endsection