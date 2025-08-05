<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->
<div>
    <section class="breadcrumb-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bc-inner">
                        <p><a href="{{ route('home') }}">Home </a> | Cart</p>
                    </div>
                </div>
                <!-- /.col-xl-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Cart Area -->
    <section class="cart-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="cart-table">

                        <table class="tables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>unit price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($carts->count() > 0)
                                @foreach($carts as $cart)
                                <tr>
                                    <td>
                                        <a style="cursor:pointer" wire:click.prevent="destroy('{{ $cart->id }}')">X</a>
                                    </td>
                                    <td>
                                        <a>
                                            <div class="product-image">
                                                <img style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $cart->title }}" src="{{ url('upload/images', $cart->image) }}">
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="product-title">
                                            <a>{{ $cart->title }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($cart->color)
                                        <p>Color:
                                            <input type="radio" name="color" value="{{ $cart->color }}" hidden>
                                            <span style="display: inline-flex; align-items: center; justify-content: center; height: 20px; width: 20px; border: 2px solid #000; border-radius: 50%;">
                                                <i class="fas fa-circle" style="color: <?= $cart->color; ?>;; font-size: 12px;"></i>
                                            </span>
                                        </p>
                                        @else
                                        <p>
                                            <strong class="text-danger">No Color!</strong>
                                        </p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cart->size)
                                        <p>
                                            Size: {{ $cart->size }}
                                        </p>
                                        @else
                                        <p>
                                            <strong class="text-danger">No Size!</strong>
                                        </p>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button wire:click.prevent="decrementQuantity('{{ $cart->id }}')" class="btn btn-sm btn-outline-secondary">-</button>
                                            <input type="number" value="{{ $cart->quantity }}" id="quantity_{{ $cart->id }}" class="form-control mx-2 text-center" style="width: 60px;" readonly>
                                            <button wire:click.prevent="incrementQuantity('{{ $cart->id }}')" class="btn btn-sm btn-outline-secondary">+</button>
                                        </div>
                                    </td>

                                    <td>
                                        <ul>
                                            <li>
                                                <div class="price-box">
                                                    <span class="price">x ${{ number_format($cart->unit_price, 2) }}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="total-price-box">
                                            <span class="price">${{ number_format($cart->price, 2) }}</span>
                                        </div>
                                    </td>


                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center text-danger">
                                        <p>No Data Found!</p>
                                        <a href="{{ route('shop')}}" class="btn-two text-white">Go to shop</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col-xl-3 -->
            </div>
            <div class="row">
                <!-- /.col-xl-9 -->
                <div class="col-xl-9">
                    <h4 class="mb-3"><strong>Customer Details</strong></h4>

                    <div class="checkout-form mt-5">
                        <div class="contact-form login-form">
                            <form wire:submit.prevent="proceedToCheckout" id="checkoutForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input wire:model.defer="name" type="text" id="name" name="name" value="{{ $user->name }}" disabled required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Email Address</label>
                                        <input wire:model.defer="email" type="email" id="email" name="email" value="{{ $user->email }}" disabled required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                        @if($errors->has('phone'))
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                        @endif
                                        <input wire:model.defer="phone" type="text" id="phone" name="phone" placeholder="+8801XXXXXXXXX" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        @if($errors->has('city'))
                                        <small class="text-danger">{{ $errors->first('city') }}</small>
                                        @endif
                                        <input wire:model.defer="city" type="text" id="city" name="city" placeholder="City name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="shipping_address">Shipping Address <span class="text-danger">*</span></label>
                                        @if($errors->has('shipping_address'))
                                        <small class="text-danger">{{ $errors->first('shipping_address') }}</small>
                                        @endif
                                        <input wire:model.defer="shipping_address" type="text" id="shipping_address" name="shipping_address" value="{{ $user->shipping_address }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="billing_address">Billing Address <span class="text-danger">*</span></label>
                                        @if($errors->has('billing_address'))
                                        <small class="text-danger">{{ $errors->first('billing_address') }}</small>
                                        @endif
                                        <input wire:model.defer="billing_address" type="text" id="billing_address" name="billing_address" value="{{ $user->billing_address }}" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="order_note">Order Note <span>(Optional)</span></label>
                                        <textarea wire:model.defer="order_note" name="order_note" id="order_note"></textarea>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-xl-3">
                    @if($carts->count() > 0)
                    <div class="cart-subtotal">
                        <p><strong>SHIPPING LOCATION</strong></p>
                        <div class="mb-4 text-left">
                            <label>
                                <input type="radio" wire:model.live="shippingLocation" value="inside">
                                Inside Dhaka (৳70)
                            </label><br>
                            <label>
                                <input type="radio" wire:model.live="shippingLocation" value="outside">
                                Outside Dhaka (৳130)
                            </label>
                        </div>

                        <p><strong>COUPON CODE</strong></p>
                        <div class="d-flex align-items-center gap-2 coupon-wrapper mb-4">
                            <input type="text" wire:model.defer="couponCode" class="coupon-input" placeholder="Copun Code" required>
                            <button wire:click.prevent="applyCoupon" class="btn btn-coupon">APPLY COUPON</button>
                        </div>

                        <p><strong>SUBTOTAL</strong></p>
                        <ul>
                            <li><span>Sub-Total:</span> ৳{{ number_format($subTotal, 2) }}</li>
                            <li><span>Shipping Cost:</span> ৳{{ number_format($shippingCost, 2) }}</li>
                            @if($discountAmount > 0)
                            <li><span>Discount:</span> ৳{{ number_format($discountAmount, 2) }}</li>
                            @endif
                            <li><span>TOTAL:</span> ৳{{ number_format($grandTotal, 2) }}</li>
                        </ul>

                        <p class="mt-4"><strong>SHIPPING LOCATION</strong></p>
                        <div class="text-left">
                            <label>
                                <input type="radio" wire:model.defer="payment_method" value="cod" id="cod" name="cod">
                                Cash On Delivery (COD)
                            </label><br>
                            <label>
                                <input type="radio" wire:model.defer="payment_method" value="bkash" id="bkash" name="bkash" disabled>
                                Payment By bkash (Upcoming)
                            </label>
                        </div>

                        <a href="#" wire:click.prevent="proceedToCheckout" wire:loading.attr="disabled" wire:target="proceedToCheckout"
                            class="">
                            <span wire:loading.remove wire:target="proceedToCheckout">
                                Place Order
                            </span>
                            <span wire:loading wire:target="proceedToCheckout">
                                Processing...
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </a>

                    </div>
                    @else
                    <div class="cart-subtotal text-muted">
                        <p><strong>SHIPPING LOCATION</strong></p>
                        <div class="mb-4 text-left">
                            <label>
                                <input type="radio" value="inside" disabled>
                                Inside Dhaka (৳70)
                            </label><br>
                            <label>
                                <input type="radio" value="outside" disabled>
                                Outside Dhaka (৳130)
                            </label>
                        </div>

                        <p><strong>COUPON CODE</strong></p>
                        <div class="d-flex align-items-center gap-2 coupon-wrapper mb-4">
                            <input type="text" wire:model.defer="couponCode" class="coupon-input" placeholder="Copun Code" disabled>
                            <button wire:click.prevent="applyCoupon" class="btn btn-coupon" disabled>APPLY COUPON</button>
                        </div>

                        <p><strong>SUBTOTAL</strong></p>
                        <ul>
                            <li><span>Sub-Total:</span> ৳{{ number_format($subTotal, 2) }}</li>
                            <li><span>Shipping Cost:</span> ৳{{ number_format($shippingCost, 2) }}</li>
                            <li><span>TOTAL:</span> ৳{{ number_format($grandTotal, 2) }}</li>
                        </ul>

                        <div class="note">
                            <span>Order Note :</span>
                            <textarea disabled></textarea>
                        </div>
                        <a href="#" class="disabled">Proceed To Checkout</a>
                    </div>
                    @endif
                    <!-- /.cart-subtotal -->
                </div>
                <!-- /.col-xl-3 -->
            </div>
        </div>
    </section>
    <!-- /.cart-area -->
</div>