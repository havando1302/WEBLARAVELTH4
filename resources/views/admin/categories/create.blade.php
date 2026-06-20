@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title mb-0">Tạo mới Danh mục con</h1>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <div class="card-custom">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold text-dark">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control form-control-lg @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" required
                               placeholder="VD: Thời Trang Nam, Thời Trang Nữ...">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold text-dark">Danh mục cha</label>
                        <div class="p-3 bg-light border rounded text-primary fw-semibold text-center">
                            {{ $mainCategory->name ?? 'Sản phẩm' }}
                        </div>
                        <input type="hidden" name="parent_id" value="{{ $mainCategory->id ?? $mainProductCategoryID }}">
                        @error('parent_id')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-plus-circle me-2"></i>Tạo danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
