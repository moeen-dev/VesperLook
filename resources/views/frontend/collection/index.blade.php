@extends('layouts.frontend')
@section('title', 'Collection')
@section('content')
<section class="breadcrumb-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bc-inner">
                    <p><a href="{{ route('home') }}">Home |</a> Collection</p>
                </div>
            </div>
            <!-- /.col-xl-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<!--=========================-->
<!--=        Collection area          =-->
<!--=========================-->

<section class="shop-area">
    <div class="container container-two">
        <div class="row">

            <div class="col-12">
                <div class="section-heading">
                    <h3>our<span> Collections</span></h3>
                </div>

                <div class="collection-filter mb-4 text-center">
                    <button class="btn btn-outline-dark btn-sm active" data-filter="all">All</button>
                    @foreach($categories as $category)
                    <button class="btn btn-outline-dark btn-sm" data-filter="category-{{ $category->id }}">
                        {{ $category->category_name }}
                    </button>
                    @endforeach
                </div>


                <div class="collection-content">
                    <div class="row">
                        @foreach($subCategories as $subCategory)
                        <div class="col-sm-6 col-lg-4 col-xl-3 mix category-{{ $subCategory->category_id }}">
                            <div class="single-collection">
                                <a href="{{ route('collection.show', ['categorySlug' => $subCategory->category->slug, 'subcategorySlug' => $subCategory->slug]) }}">
                                    <img src="{{ url('upload/images', $subCategory->image) }}" alt="{{ $subCategory->subcategory_name }}">
                                </a>
                                <a href="{{ route('collection.show', ['categorySlug' => $subCategory->category->slug, 'subcategorySlug' => $subCategory->slug]) }}">
                                    <h3>{{ $subCategory->subcategory_name }}</h3>
                                    <p>{{ $subCategory->products_count }} Items</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- /.shop-content -->
            </div>
            <!-- /.col-xl-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.shop-area -->
@endsection