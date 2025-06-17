@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Sửa đơn hàng</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block mb-1">Khách hàng</label>
                <select id="user_id" name="user_id" class="w-full p-2 border rounded" required>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block mb-1">Tên người nhận</label>
                <input type="text" name="name" id="name" value="{{ $order->name }}" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block mb-1">Số điện thoại</label>
                <input type="text" name="phone" id="phone" value="{{ $order->phone }}" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block mb-1">Địa chỉ</label>
                <textarea name="address" id="address" class="w-full p-2 border rounded" required>{{ $order->address }}</textarea>
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block mb-1">Phương thức thanh toán</label>
                <select name="payment_method" id="payment_method" class="w-full p-2 border rounded" required>
                    <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận (COD)</option>
                    <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                    <option value="momo" {{ $order->payment_method == 'momo' ? 'selected' : '' }}>Ví MoMo</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="note" class="block mb-1">Ghi chú</label>
                <textarea name="note" id="note" class="w-full p-2 border rounded">{{ $order->note }}</textarea>
            </div>

            <div class="mb-4">
                <label for="total" class="block mb-1">Tổng tiền (VNĐ)</label>
                <input type="number" id="total" name="total" value="{{ $order->total }}" step="0.01" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="status" class="block mb-1">Trạng thái</label>
                <select id="status" name="status" class="w-full p-2 border rounded" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Cập nhật đơn hàng
            </button>
        </form>
    </div>
@endsection
