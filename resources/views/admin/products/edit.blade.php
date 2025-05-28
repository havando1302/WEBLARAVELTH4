@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Sửa sản phẩm</h1>
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $product->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                    <input type="number" id="price" name="price" value="{{ $product->price }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" step="0.01" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Số lượng tồn kho</label>
                    <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="image_url" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                    <input type="file" id="image_url" name="image_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @if($product->image_url)
                        <img src="{{ Storage::url($product->image_url) }}" class="mt-2 w-32 h-32 object-cover rounded-md" alt="{{ $product->name }}">
                    @endif
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded">
                    Cập nhật sản phẩm
                </button>
            </div>
        </form>
    </div>
@endsection