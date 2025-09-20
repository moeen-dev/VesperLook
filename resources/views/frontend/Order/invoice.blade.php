<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - Invoice of {{ $order->name }}</title>
    <link rel="stylesheet" href="style.css" media="all" />

    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 100px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: rgb(255, 255, 255);
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background-color: #d4a15d;
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 87px;
            margin-right: 10px;
            display: inline-block;
            font-size: 1em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service {
            text-align: left;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc,
        table td.total-price,
        table td.unit-price {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #d4a15d;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div class="logo">
            <img src="{{ public_path('assets/frontend/media/images/logo.png') }}">
        </div>
        <h1>INVOICE NO #{{ $order->id }}</h1>
        <div id="company" class="clearfix">
            <div>{{ config('app.name') }}</div>
            <div>House #05, Road #05, Sector #12<br /> Uttara, Dhaka-1230, Bangladesh</div>
            <div>+880 2 55086633</div>
            <div><a href="mailto:info@vesperlook.com">info@vesperlook.com</a></div>
        </div>
        <div id="project">
            <div><span>Order By</span> {{ $order->name }}</div>
            <div><span>Shipping Address</span> {{ $order->shipping_address }}</div>
            <div><span>Billing Address</span> {{ $order->billing_address }}</div>
            <div><span>Eamil</span> {{ $order->email }}</div>
            <div><span>Order Created at</span> {{ $order->created_at->format('d M Y') }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th class="service text-left">Product Name</th>
                    <th class="unit-price text-center">Unit Price</th>
                    <th class="desc text-center">Quantity</th>
                    <th class="total-price text-right">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td class="service text-left">{{ $item->title }}</td>
                        <td class="unit text-center">{{ $item->unit_price }} TK</td>
                        <td class="desc text-center">{{ $item->quantity }}</td>
                        <td class="qty text-right">{{ $item->total_price }} TK</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total text-right">{{ number_format($order->subtotal, 2) }} TK</td>
                </tr>
                @if ($order->discount > 0)
                    <tr>
                        <td colspan="4">Discount</td>
                        <td class="total text-right">- {{ number_format($order->discount, 2) }} TK</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="4">Delivery</td>
                    <td class="total text-right">{{ number_format($order->shipping_cost, 2) }} TK</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total text-right">{{ number_format($order->total, 2) }} TK</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>Order Note:</div>
            <div class="notice">{{ $order->order_note }}</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
