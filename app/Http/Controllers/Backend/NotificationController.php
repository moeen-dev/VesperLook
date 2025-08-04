<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notification = Auth::guard('admin')->user()->notifications->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            $orderId = $notification->data['data']['order_id'] ?? null;
            if (!$orderId) {
                return back()->with('error', 'Order ID not found in notification data.');
            }

            $order = Order::find($orderId);
            if ($order) {
                return redirect()->route('orders.show', $order->id);
            } else {
                return back()->with('error', 'Order not found.');
            }
        } else {
            return back()->with('error', 'Notification not found.');
        }
    }
}
