@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="page-title mb-0">Chỉnh sửa sản phẩm: {{ $product->name }}</h1>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Main Product Info -->
                    <div class="col-12 col-lg-8">
                        <div class="card-custom mb-4">
                            <h5 class="fw-bold mb-4">Thông tin chung</h5>

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $product->name) }}">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Mô tả chi tiết <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Variants -->
                        <div class="card-custom">
                            <h5 class="fw-bold mb-4">Biến thể sản phẩm</h5>
                            <div id="variant-container">
                                @php
                                    $oldVariants = old('variants', []);
                                @endphp

                                @if (count($oldVariants) > 0)
                                    @foreach ($oldVariants as $index => $variant)
                                        <div class="variant-group row g-2 mb-3 align-items-end" data-index="{{ $index }}">
                                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant['id'] ?? '' }}">
                                            <div class="col-md-3">
                                                <label class="form-label small text-muted">Màu sắc</label>
                                                <input type="text" name="variants[{{ $index }}][color_name]" class="form-control" required value="{{ $variant['color_name'] }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small text-muted">Kích cỡ</label>
                                                <input type="text" name="variants[{{ $index }}][size_name]" class="form-control" required value="{{ $variant['size_name'] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small text-muted">Số lượng</label>
                                                <input type="number" name="variants[{{ $index }}][stock]" class="form-control" min="0" required value="{{ $variant['stock'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-outline-danger w-100 remove-variant-button">Xóa</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach ($product->variants as $index => $variant)
                                        <div class="variant-group row g-2 mb-3 align-items-end" data-index="{{ $index }}">
                                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                            <div class="col-md-3">
                                                <label class="form-label small text-muted">Màu sắc</label>
                                                <input type="text" name="variants[{{ $index }}][color_name]" class="form-control" required value="{{ old('variants.'.$index.'.color_name', $variant->color_name) }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small text-muted">Kích cỡ</label>
                                                <input type="text" name="variants[{{ $index }}][size_name]" class="form-control" required value="{{ old('variants.'.$index.'.size_name', $variant->size_name) }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small text-muted">Số lượng</label>
                                                <input type="number" name="variants[{{ $index }}][stock]" class="form-control" min="0" required value="{{ old('variants.'.$index.'.stock', $variant->stock) }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-outline-danger w-100 remove-variant-button">Xóa</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add-variant-button" class="btn btn-sm btn-outline-primary mt-2">
                                <i class="fa-solid fa-plus me-1"></i> Thêm biến thể
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar Setup Info -->
                    <div class="col-12 col-lg-4">
                        <div class="card-custom mb-4">
                            <h5 class="fw-bold mb-4">Phân loại & Giá</h5>

                            <div class="mb-4">
                                <label for="price" class="form-label fw-bold">Giá bán (VNĐ) <span class="text-danger">*</span></label>
                                <input type="number" name="price" id="price" step="1000" class="form-control" required value="{{ old('price', $product->price) }}">
                            </div>

                            <div class="mb-4">
                                <label for="category_id" class="form-label fw-bold">Danh mục con <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-custom mb-4">
                            <h5 class="fw-bold mb-4">Hình ảnh sản phẩm</h5>
                            
                            @if ($product->image_url)
                                <div class="mb-3 text-center">
                                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif

                            <div class="mb-3">
                                <input type="file" name="image_url" id="image_url" class="form-control" accept="image/*">
                                <div class="form-text mt-2">Để trống nếu không muốn thay đổi ảnh.</div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-save me-2"></i>Cập nhật sản phẩm
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let variantIndex = {{ count(old('variants', $product->variants)) }};

    function createVariantGroup(index, data = {}) {
        return `
            <div class="variant-group row g-2 mb-3 align-items-end" data-index="${index}">
                <input type="hidden" name="variants[${index}][id]" value="${data.id ?? ''}">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Màu sắc</label>
                    <input type="text" name="variants[${index}][color_name]" class="form-control" required value="${data.color_name ?? ''}" placeholder="VD: Đỏ">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Kích cỡ</label>
                    <input type="text" name="variants[${index}][size_name]" class="form-control" required value="${data.size_name ?? ''}" placeholder="VD: L">
                </div>
                <div class="col-md-4">
                    <label class="form-label small text-muted">Số lượng</label>
                    <input type="number" name="variants[${index}][stock]" class="form-control" min="0" required value="${data.stock ?? 0}">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger w-100 remove-variant-button">Xóa</button>
                </div>
            </div>
        `;
    }

    document.getElementById('add-variant-button').addEventListener('click', () => {
        const container = document.getElementById('variant-container');
        container.insertAdjacentHTML('beforeend', createVariantGroup(variantIndex));
        variantIndex++;
    });

    document.getElementById('variant-container').addEventListener('click', function(e) {
        if (e.target.closest('.remove-variant-button')) {
            e.target.closest('.variant-group').remove();
        }
    });
</script>
@endsection
