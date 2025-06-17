@extends('layouts.app')

@section('content')
<div class="w-full max-w-screen-xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">🛒 Tydy xin chào quý khách!</h2>

    <!-- Tabs -->
    <div class="flex border-b border-gray-200 mb-6">
        <button id="tab-cart-btn" class="py-2 px-4 text-blue-600 border-b-2 border-blue-600 font-semibold focus:outline-none">
            Giỏ hàng của bạn
        </button>
        <button id="tab-orders-btn" class="ml-4 py-2 px-4 text-gray-600 hover:text-blue-600 border-b-2 border-transparent font-semibold focus:outline-none">
            Đơn hàng của bạn
        </button>
    </div>

    <!-- Tab Cart -->
    <div id="tab-cart">
        @if ($cartItems->isEmpty())
            <div class="bg-white p-6 text-center rounded-lg shadow">
                <h2 class="text-xl font-semibold text-gray-800">Giỏ hàng của bạn đang trống</h2>
                <p class="mt-2 text-gray-500">Hãy thêm sản phẩm vào giỏ hàng để bắt đầu mua sắm.</p>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Giá</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Số lượng</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Màu</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Size</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tổng cộng</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="{{ $item->product && $item->product->image_url ? asset('storage/' . $item->product->image_url) : asset('images/default-product.png') }}"
                                                 alt="{{ $item->product->name ?? 'Hình ảnh sản phẩm' }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}';"
                                                 class="w-16 h-16 object-cover rounded border border-gray-200">
                                            <div class="ml-4 text-sm font-medium text-gray-900">
                                                {{ $item->product->name ?? 'Sản phẩm không có tên' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ number_format($item->product->price ?? 0) }} VNĐ
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $item->color->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $item->size->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                        {{ number_format(($item->product->price ?? 0) * $item->quantity) }} VNĐ
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                                Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-gray-50">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold text-gray-800">Tổng thanh toán:</span>
                        <span class="text-2xl font-bold text-red-600">
                            {{ number_format($cartItems->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity)) }} VNĐ
                        </span>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('checkout') }}" class="block w-full text-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md transition">
                            Xác nhận đặt hàng
                        </a>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                            Hoặc tiếp tục mua sắm →
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Tab Orders -->
    <div id="tab-orders" class="hidden">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">📦 Đơn hàng của bạn</h3>
        @forelse ($orders as $order)
            <div class="bg-white rounded-lg shadow p-4 mb-6 border border-gray-200">
                <p class="text-sm text-gray-700"><strong>Khách hàng:</strong> {{ $order->name }}</p>
                <p class="text-sm text-gray-700"><strong>SĐT:</strong> {{ $order->phone }}</p>
                <p class="text-sm text-gray-700"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                <p class="text-sm mt-1"><strong>Trạng thái:</strong>
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))) }}">
                        {{ $order->statusText }}
                    </span>
                </p>

                <button class="mt-3 mb-2 text-blue-600 hover:text-blue-800 font-semibold" onclick="document.getElementById('order-details-{{ $order->id }}').classList.toggle('hidden')">
                    Xem chi tiết
                </button>

                <div id="order-details-{{ $order->id }}" class="hidden border-t pt-3 border-gray-200 space-y-2">
                    @foreach ($order->items as $item)
                        <div class="text-sm text-gray-800">
                            <strong>Sản phẩm:</strong> {{ $item->product ? $item->product->name : 'Sản phẩm không tồn tại' }} |
                            <strong>Size:</strong> {{ $item->size ? $item->size->name : 'N/A' }} |
                            <strong>Màu:</strong> {{ $item->color ? $item->color->name : 'N/A' }} |
                            <strong>Số lượng:</strong> {{ $item->quantity }} |
                            <strong>Giá:</strong> {{ number_format($item->price) }} VNĐ
                        </div>
                    @endforeach
                </div>

                <p class="mt-3 text-right font-bold text-lg text-red-600">
                    Tổng tiền: {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity)) }} VNĐ
                </p>

                @if ($order->status === 'pending')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <textarea name="cancellation_reason" placeholder="Nhập lý do hủy" required class="w-full p-2 border rounded"></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hủy đơn</button>
                    </form>
                @else
                    <p class="mt-4 text-gray-500">Đơn hàng không thể hủy.</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500">Bạn chưa có đơn hàng nào.</p>
        @endforelse
    </div>
</div>

<script>
    const tabCartBtn = document.getElementById('tab-cart-btn');
    const tabOrdersBtn = document.getElementById('tab-orders-btn');
    const tabCart = document.getElementById('tab-cart');
    const tabOrders = document.getElementById('tab-orders');

    tabCartBtn.addEventListener('click', () => {
        tabCart.classList.remove('hidden');
        tabOrders.classList.add('hidden');
        tabCartBtn.classList.add('text-blue-600', 'border-blue-600');
        tabCartBtn.classList.remove('text-gray-600', 'border-transparent');
        tabOrdersBtn.classList.remove('text-blue-600', 'border-blue-600');
        tabOrdersBtn.classList.add('text-gray-600', 'border-transparent');
    });

    tabOrdersBtn.addEventListener('click', () => {
        tabOrders.classList.remove('hidden');
        tabCart.classList.add('hidden');
        tabOrdersBtn.classList.add('text-blue-600', 'border-blue-600');
        tabOrdersBtn.classList.remove('text-gray-600', 'border-transparent');
        tabCartBtn.classList.remove('text-blue-600', 'border-blue-600');
        tabCartBtn.classList.add('text-gray-600', 'border-transparent');
    });
</script>
@endsection