<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function download($id)
    {
        $order = Order::with('items')->findOrFail($id);

        if ($order->user_id !==  Auth::guard('user')->id()) {
            abort(403, 'Unauthorized access to invoice');
        }

        $pdf = PDF::loadView('frontend.order.invoice', compact('order'))
            ->setPaper([0, 0, 700, 900]);

        return $pdf->download('invoice-order-' . $order->id . '-' . Str::random(5) . '.pdf');
    }

    public function success()
    {
        return view('frontend.order.success');
    }

    public function downloadInvoice($filename)
    {
        $filePath = storage_path('app/private/invoices/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'Invoice not found.');
        }

        return Response::download($filePath, $filename);
    }
}
