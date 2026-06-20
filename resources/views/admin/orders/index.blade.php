@extends('layouts.admin')

@section('content')
<style>
    .admin-orders-page {
        padding: 0;
    }

    .admin-orders-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 24px;
    }

    .orders-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        border: 1px solid #F3F4F6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .orders-table thead tr {
        background: linear-gradient(135deg, #FAFAF8, #F3F4F6);
    }

    .orders-table th {
        padding: 16px 18px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
    }

    .orders-table td {
        padding: 14px 18px;
        border-top: 1px solid #F3F4F6;
        font-size: 0.9rem;
        color: #374151;
    }

    .orders-table tbody tr {
        transition: background 0.2s;
    }

    .orders-table tbody tr:hover {
        background: #FAFAF8;
    }

    .orders-total-cell {
        font-weight: 700;
        color: #DC2626;
    }

    .order-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .status-pending { background: #F3F4F6; color: #6B7280; }
    .status-processing { background: #FEF3C7; color: #D97706; }
    .status-shipped { background: #DBEAFE; color: #2563EB; }
    .status-completed { background: #D1FAE5; color: #059669; }
    .status-cancelled { background: #FEE2E2; color: #DC2626; }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(27, 42, 74, 0.3);
        color: white;
    }

    @media (max-width: 768px) {
        .orders-table {
            font-size: 0.82rem;
        }

        .orders-table th,
        .orders-table td {
            padding: 10px 12px;
        }
    }
</style>

<div class="admin-orders-page">
    <div class="admin-orders-header">
        <h1><i class="fa-solid fa-box" style="color: #C8956C; margin-right: 8px;"></i> Danh Sách Đơn Hàng</h1>
    </div>

    <div style="overflow-x: auto;">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Thanh toán</th>
                    <th>Ghi chú</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->note ?? '—' }}</td>
                        <td class="orders-total-cell">{{ number_format($order->total) }} VNĐ</td>
                        <td>
                            <span class="order-status-badge
                                {{ $order->status === 'completed' ? 'status-completed' :
                                   ($order->status === 'shipped' ? 'status-shipped' :
                                   ($order->status === 'processing' ? 'status-processing' :
                                   ($order->status === 'cancelled' ? 'status-cancelled' : 'status-pending'))) }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn-detail">
                                <i class="fa-solid fa-eye"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
