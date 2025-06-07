<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng - {{ $orderCode ?? 'Mã đơn hàng' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            padding: 30px 10px;
            margin: 0;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #BC435E;
            margin: 0;
        }
        .order-info p {
            margin: 8px 0;
            font-size: 15px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th {
            background-color: #BC435E;
            color: #fff;
            padding: 12px;
            text-align: left;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
            color: #BC435E;
        }
        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #777;
            text-align: center;
            line-height: 1.5;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }
        .highlight {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Cảm ơn bạn đã đặt hàng tại {{ config('app.name') }}</h2>
            <p>Mã đơn hàng: <span class="highlight">{{ $orderCode }}</span></p>
            <p>Trạng thái : <strong style="color: #BC435E;">{{$status}}</strong></p>
        </div>

        <div class="order-info">
            <p><strong>Khách hàng:</strong> {{ $fullname ?? 'Nguyễn Văn A' }}</p>
            <p><strong>Email:</strong> {{ $email ?? 'email@example.com' }}</p>
            <p><strong>SĐT:</strong> {{ $phone ?? '0123456789' }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $address ?? '123 Đường ABC, Quận 1, TP.HCM' }}</p>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCartBuy as $item)
                    <tr>
                        <td>{{ $item->product->name }} <strong>{{$item->color? $item->color :''}}</strong></td> 
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                        <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Tổng tiền gốc: {{ number_format(($totalAmount + $discountAmount), 0, ',', '.') }}₫</p>
        <p class="total">Giảm giá: -{{ number_format($discountAmount, 0, ',', '.') }}₫</p>
        <p class="total"><strong>Tổng thanh toán:</strong> {{ number_format($totalAmount, 0, ',', '.') }}₫</p>

        <div class="footer">
            <p>Đây là email tự động từ hệ thống {{ config('app.name') }}.</p>
            <p>Vui lòng không trả lời email này.</p>
            <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
