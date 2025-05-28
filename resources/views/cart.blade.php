@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">🛒 Giỏ hàng của bạn</h2>

    @if ($cartItems->isEmpty())
        <div class="text-center text-gray-500 py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218
                      c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6
                      20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
            </svg>
            <p class="mt-4 text-xl font-semibold text-gray-700">Giỏ hàng của bạn đang trống.</p>
            <p class="mt-2 text-gray-500">Có vẻ như bạn chưa thêm sản phẩm nào. Hãy khám phá cửa hàng nhé!</p>

            <div class="mt-8">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-black bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Khám phá sản phẩm
                </a>
            </div>

            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-800 mb-6">🔥 Sản phẩm được yêu thích</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($popularProducts as $product)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}';">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-green-600 font-bold mt-2">{{ number_format($product->price) }} VNĐ</p>
                                <a href="{{ route('products.show', $product->id) }}"
                                class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-semibold text-black bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition duration-150 ease-in-out">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Chưa có sản phẩm yêu thích nào được hiển thị.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng cộng</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 sm:h-20 sm:w-20">
                                            <img class="h-16 w-16 sm:h-20 sm:w-20 rounded-md object-cover border border-gray-200"
                                                 src="{{ $item->product && $item->product->image_url ? asset('storage/' . $item->product->image_url) : asset('images/default-product.png') }}"
                                                 alt="{{ $item->product->name ?? 'Hình ảnh sản phẩm' }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}';">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->product->name ?? 'Sản phẩm không có tên' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ number_format($item->product->price ?? 0) }} VNĐ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    {{ number_format(($item->product->price ?? 0) * $item->quantity) }} VNĐ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <form action="{{ route('cart.remove', $item->product_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')"
                                                class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tổng kết giỏ hàng</h3>

                <div class="border-t border-gray-200 my-3"></div>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-900">Tổng thanh toán:</span>
                    <span class="text-2xl font-bold text-red-600">
                        {{ number_format($cartItems->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity)) }} VNĐ
                    </span>
                </div>

                <div class="mt-6">
                    <a href="{{ route('checkout.index') }}"
                       class="w-full flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-semibold text-black bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition duration-150 ease-in-out">
                        Tiến hành Thanh toán
                    </a>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}"
                       class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                        Hoặc tiếp tục mua sắm <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
