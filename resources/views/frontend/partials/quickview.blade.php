            <div class="quickview quicview-content">
                <div class="row">
                    <div class="col-12">
                        <span class="close-qv">
                            <i class="flaticon-close"></i>
                        </span>
                    </div>
                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <div class="product-details">
                            <h5 class="pro-title"><a href="#">{{ $product->title }}</a></h5>
                            <div class="">
                                @if ($product->quantity > 0)
                                <span style="font-weight: 500; font-size: 13px;" class="badge badge-success text-white">In Stock</span>
                                @else
                                <span style="font-weight: 500; font-size: 13px;" class="badge badge-danger text-white">Out of Stock</span>
                                @endif

                                @if ($product->is_new && $product->created_at->diffInDays(now()) <= 10)
                                    <span style="font-weight: 500; font-size: 13px;" class="badge badge-primary text-white">New</span>
                                    @endif

                                    @if ($product->quantity <= 10 && $product->quantity > 0)
                                        <span style="font-weight: 500;  font-size: 13px;" class="badge badge-info text-white">{{ $product->quantity }} left</span>
                                        @endif
                            </div>
                            <span class="price">Price : ${{ $product->price }}</span>

                            <form id="add-to-cart-form-{{ $product->id }}" action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="size-variation">
                                    @if($product->sizes && count($product->sizes) > 0)
                                    <span>size : </span>
                                    <select name="size" required>
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
                                                <input type="radio" name="color" value="{{ $color }}" hidden required>
                                                <i class="fas fa-circle" style="color: <?= $color; ?>;"></i>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <span class="">Color: No Color Available for this Product.</span>
                                    @endif
                                </div>
                            </form>

                            <p class="product-description">{!! Str::limit(strip_tags($product->description), 325) !!}
                            </p>

                            <div class="add-tocart-wrap">
                                @if($product->quantity > 1)
                                <a href="javascript:void(0);" class="add-to-cart"
                                    onclick="document.getElementById('add-to-cart-form-{{ $product->id }}').submit();">
                                    <i class="flaticon-shopping-purse-icon"></i>
                                    Add Cart
                                </a>
                                @else
                                <a class="add-to-cart disabled"><i class="flaticon-shopping-purse-icon"></i> Out Of Stock</a>
                                @endif
                                <a href="{{ route('shop.details', ['categorySlug' => $product->subCategory->category->slug, 'subcategorySlug' => $product->subCategory->slug, 'productSlug' => $product->slug]) }}" class="add-to-cart">
                                    <i class="fas fa-info-circle"></i>
                                    More Info</a>
                            </div>

                            <div class="mt-3">
                                <!-- SKU Section -->
                                <span>SKU: {{ $product->sku ?? 'N/A' }}</span>
                            </div>

                        </div>
                        <!-- /.product-details -->
                    </div>
                    <!-- /.col-xl-6 -->
                </div>
            </div>