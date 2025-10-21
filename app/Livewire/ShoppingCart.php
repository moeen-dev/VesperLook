<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class ShoppingCart extends Component
{

    // Shipping properties
    public $shippingLocation = '';
    public $shippingCost = 0;

    // Coupon properties
    public $couponCode = '';
    public $discountAmount = 0;
    public $discountPercent = 0;
    public $discountCodeApplied = null;

    // Place Order
    public $name, $email, $phone, $city, $shipping_address, $billing_address, $order_note, $payment_method;

    public function updatedShippingLocation($value)
    {
        $this->shippingCost = $value === 'outside' ? 130 : ($value === 'inside' ? 70 : 0);
    }

    public function mount()
    {
        $user = Auth::guard('user')->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->shipping_address = $user->shipping_address;
        $this->billing_address = $user->billing_address;
    }


    // Apply coupon
    public function applyCoupon()
    {
        $user = Auth::guard('user')->user();
        if (!$user) {
            $this->dispatch('toast', type: 'error', title: 'Error!', message: 'Please log in to apply coupons.');
            return;
        }

        $discount = Discount::where('code', $this->couponCode)
            ->where('expires_at', '>', now())
            ->first();

        if (!$discount) {
            $this->resetCoupon();
            $this->dispatch('toast', type: 'error', title: 'Invalid!', message: 'Coupon is invalid or expired.');
            return;
        }

        $carts = Cart::where('user_id', $user->id)->get();
        $subTotal = $carts->sum('price');

        if ($subTotal < $discount->min_order_amount) {
            $this->resetCoupon();
            $this->dispatch('toast', type: 'warning', title: 'Not Met', message: "Minimum order amount for this coupon is {$discount->min_order_amount} Tk.");
            return;
        }

        $this->discountPercent = $discount->discount_percent;
        $this->discountAmount = ($discount->discount_percent / 100) * $subTotal;
        $this->discountCodeApplied = $discount->code;

        $this->dispatch('toast', type: 'success', title: 'Success!', message: "Coupon applied! You saved {$this->discountAmount} Tk.");
    }

    public function removeCoupon()
    {
        $this->resetCoupon();
        $this->dispatch('toast', type: 'info', title: 'Removed', message: 'Coupon removed successfully.');
    }

    private function resetCoupon()
    {
        $this->couponCode = '';
        $this->discountAmount = 0;
        $this->discountPercent = 0;
        $this->discountCodeApplied = null;
    }


    // Render function
    public function render()
    {
        $user = Auth::guard('user')->user();

        if (!$user) {
            return view('livewire.shopping-cart', [
                'carts' => collect(),
                'subTotal' => 0,
                'cartTotal' => 0,
                'shippingCost' => $this->shippingCost,
                'discountAmount' => $this->discountAmount,
                'grandTotal' => 0,
                'discountCodeApplied' => $this->discountCodeApplied,
            ]);
        }

        $carts = Cart::with('product')->where('user_id', $user->id)->get();
        $subTotal = $carts->sum('price');
        $cartTotal = $subTotal;
        $grandTotal = $subTotal + $this->shippingCost - $this->discountAmount;

        foreach ($carts as $cart) {
            $unitPrice = $cart->product ? $cart->product->price : 0;
            $cart->unit_price = $unitPrice;
        }

        return view('livewire.shopping-cart', [
            'user' => $user,
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'subTotal' => $subTotal,
            'shippingCost' => $this->shippingCost,
            'discountAmount' => $this->discountAmount,
            'grandTotal' => $grandTotal,
            'discountCodeApplied' => $this->discountCodeApplied,
        ]);
    }

    // Shopping Cart Increment
    public function incrementQuantity($cartId)
    {
        $cartItem = Cart::find($cartId);
        $product = Product::find($cartItem->product_id);

        if ($cartItem && $product) {
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->quantity++;
                $cartItem->price = $product->price * $cartItem->quantity;
                $cartItem->save();

                $this->dispatch('toast', type: 'success', title: 'Success!', message: 'Quantity increased successfully!');
            } else {
                $this->dispatch('toast', type: 'error', title: 'Oops!', message: 'No more stock available.');
            }
        }
    }


    // Shopping Cart Decrement
    public function decrementQuantity($cartId)
    {
        $cartItem = Cart::find($cartId);
        $product = Product::find($cartItem->product_id);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->price = $product->price * $cartItem->quantity;
            $cartItem->save();

            $this->dispatch('toast', type: 'success', title: 'Success!', message: 'Quantity decreased successfully!');
        } else {
            $this->dispatch('toast', type: 'info', title: 'Heads up!', message: 'Quantity cannot be less than 1!');
        }
    }

    // Shopping Cart Destroy
    public function destroy($id)
    {
        $cart = Cart::findOrFail(intval($id));

        $cart->delete();
        $this->dispatch('toast', type: 'success', title: 'Success!', message: 'Product Destroyed successfully!');
    }

    // Proceed to Checkout
    public function proceedToCheckout()
    {
        if (empty($this->shippingLocation)) {
            $this->dispatch('toast', type: 'warning', title: 'Notice!', message: 'Please select a shipping location before proceeding!');
            return;
        }

        if (empty($this->payment_method)) {
            $this->dispatch('toast', type: 'warning', title: 'Notice!', message: 'Please select a payment method before proceeding!');
            return;
        }

        $this->validate([
            'phone' => 'required|regex:/^\+8801[3-9][0-9]{8}$/',
            'city' => 'required|string',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'payment_method' => 'required|in:cod,bkash',
        ]);

        $user = Auth::guard('user')->user();
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        $subtotal = $carts->sum('price');
        $discount = $this->discountAmount;
        $shipping = $this->shippingCost;
        $total = $subtotal + $shipping - $discount;


        $order = Order::create([
            'user_id' => $user->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->billing_address,
            'order_note' => $this->order_note,
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'discount' => $discount,
            'payment_method' => $this->payment_method,
            'delivery_status' => 'pending',
            'total' => $total,
        ]);


        foreach ($carts as $cart) {
            $unitPrice = $cart->product ? $cart->product->price : 0;
            $cart->unit_price = $unitPrice;
            // product quantity after place an order
            $product = $cart->product;
            if ($product && $product->quantity >= $cart->quantity) {
                $product->quantity -= $cart->quantity;
                $product->save();
            } else {
                // Optional: Handle if product is out of stock
                session()->flash('error', "Product {$product->title} does not have enough stock.");
                return;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'title' => $cart->title,
                'image' => $cart->image,
                'color' => $cart->color,
                'size' => $cart->size,
                'quantity' => $cart->quantity,
                'unit_price' => $cart->product->price,
                'total_price' => $cart->price,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        // session()->flash('success', 'Order placed successfully!');

        $pdf = Pdf::loadView('frontend.order.invoice', ['order' => $order])
            ->setPaper([0, 0, 700, 900])
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $filename = 'invoice-order-' . $order->id . '-' . Str::random(5) . '.pdf';

        $directoryPath = storage_path('app/private/invoices');
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        $path = $directoryPath . '/' . $filename;
        file_put_contents($path, $pdf->output());


        Mail::to($order->email)->send(new OrderConfirmationMail($order, $path));

        $admins = User::where('is_admin', 1)->get();

        $data = [
            'user_image' => $user->image,
            'user_name' => $user->name,
            'order_id' => $order->id,
        ];

        foreach ($admins as $admin) {
            Notification::send($admin, new OrderNotification($data));
        }

        // Success message showing by toast
        session()->flash('success', 'Order placed successfully! The invoice has been sent to your email.');

        // Redirect to success page
        return redirect()->route('order.success')->with('invoice_download_path', $filename);
    }
}
