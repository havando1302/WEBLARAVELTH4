@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Danh sách đơn hàng</h1>

        <div class="overflow-x-auto">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Phương thức thanh toán</th>
                        <th>Ghi chú</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->note ?? '—' }}</td>
                            <td>{{ number_format($order->total) }} VNĐ</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{ route('admin.orders.edit', $order) }}" class="btn-detail">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .orders-table thead tr {
            background-color: #f8fafc;
            font-weight: bold;
            text-align: left;
        }

        .orders-table th,
        .orders-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .orders-table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .btn-detail {
            background-color: #3b82f6;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-detail:hover {
            background-color: #2563eb;
        }

        /* Optional dark mode support */
        .dark .orders-table {
            background-color: #1e293b;
            color: #f1f5f9;
        }

        .dark .orders-table thead tr {
            background-color: #334155;
        }

        .dark .orders-table tbody tr:hover {
            background-color: #475569;
        }

        .dark .btn-detail {
            background-color: #60a5fa;
            color: #1e293b;
        }

        .dark .btn-detail:hover {
            background-color: #3b82f6;
        }
    </style>
@endsection
