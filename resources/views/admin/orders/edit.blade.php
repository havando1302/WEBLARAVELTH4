@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title mb-0">Cập nhật đơn hàng #{{ $order->id }}</h1>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-custom">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_id" class="form-label fw-bold">Khách hàng</label>
                                <select id="user_id" name="user_id" class="form-select" required>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Tên người nhận</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $order->name) }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $order->phone) }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">Địa chỉ giao hàng</label>
                                <textarea name="address" id="address" rows="3" class="form-control" required>{{ old('address', $order->address) }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_method" class="form-label fw-bold">Phương thức thanh toán</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận (COD)</option>
                                    <option value="bank_transfer" {{ $order->payment_method == 'bank_transfer' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                                    <option value="momo" {{ $order->payment_method == 'momo' ? 'selected' : '' }}>Ví MoMo</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label fw-bold">Tổng tiền (VNĐ)</label>
                                <input type="number" id="total" name="total" value="{{ old('total', $order->total) }}" step="1000" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold">Trạng thái đơn hàng</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label fw-bold">Ghi chú</label>
                                <textarea name="note" id="note" rows="2" class="form-control">{{ old('note', $order->note) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-save me-2"></i>Cập nhật đơn hàng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
