@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
             alt="{{ $product->name }}"
             class="w-full h-64 object-cover rounded mb-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <p class="text-xl text-green-600 font-semibold mb-2">{{ number_format($product->price) }} VNĐ</p>
        <p class="text-gray-700 mb-6">{{ $product->description }}</p>
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">← Quay lại</a>
    </div>
</div>
@endsection
