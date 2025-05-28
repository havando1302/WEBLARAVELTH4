@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🧾 Thanh toán đơn hàng</h2>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf

        {{-- Hiển thị các phương thức thanh toán --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Chọn phương thức thanh toán:</label>
            <div class="space-y-3">
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="cod" checked class="form-radio text-indigo-600">
                    <span class="ml-2">Thanh toán khi nhận hàng (COD)</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="bank_transfer" class="form-radio text-indigo-600">
                    <span class="ml-2">Chuyển khoản ngân hàng</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="momo" class="form-radio text-indigo-600">
                    <span class="ml-2">Ví MoMo</span>
                </label>
            </div>
        </div>

        <button type="submit"
            class="w-full flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-semibold text-black bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition duration-150 ease-in-out">
            Xác nhận thanh toán
        </button>
    </form>
</div>
@endsection
