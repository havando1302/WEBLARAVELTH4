@extends('layouts.app')

@section('title', 'Tạo Danh mục con mới')

@section('content')
<style>
 
    .card-header-custom {
        background: linear-gradient(to right, #4e73df, #1cc88a); 
        color: white;
        padding: 1.5rem;
        border-top-left-radius: 0.5rem; 
        border-top-right-radius: 0.5rem;
    }

    .form-control-highlight {
        border-color: #1cc88a; 
        box-shadow: 0 0 0 0.25rem rgba(28, 200, 138, 0.25); 
    }

    .btn-create-category {
        background-color: #1cc88a; 
        color: white;
        padding: 0.75rem 2rem; 
        font-size: 1.1rem; 
        border-radius: 0.5rem; 
        transition: background-color 0.3s ease; 
    }

    .btn-create-category:hover {
        background-color: #17a673; 
        color: white; 
    }

    .form-label-custom {
        font-size: 1.1rem;
        color: #333;
    }

    .parent-category-display {
        background-color: #f8f9fc; 
        border: 1px solid #e0e0e0; 
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #4e73df; 
        border-radius: 0.375rem;
        display: block; 
        text-align: center;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9"> 

            <div class="card shadow-lg rounded-lg border-0"> 
                <div class="card-header card-header-custom text-center">
                    <h3 class="mb-0 fw-bold">Tạo mới danh mục mới cho <span class="text-warning">"Sản phẩm"</span></h3>
                </div>

                <div class="card-body p-4"> 
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        {{-- Tên danh mục con --}}
                        <div class="mb-4">
                            <label for="name" class="form-label form-label-custom d-block text-center mb-2">Tên danh mục:</label>
                            <input type="text" name="name" id="name"
                                   class="form-control form-control-lg w-75 mx-auto @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required
                                   placeholder="Ví dụ: Thời Trang Nam, Thời Trang Nữ....">
                            @error('name')
                                <div class="text-danger mt-2 text-center small">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-5"> 
                            <label class="form-label form-label-custom d-block text-center mb-2">Danh mục cha:</label>
                            <div class="parent-category-display w-75 mx-auto">
                                {{ $mainCategory->name ?? 'Sản phẩm' }} 
                            </div>
                        
                            <input type="hidden" name="parent_id" value="{{ $mainCategory->id ?? $mainProductCategoryID }}">
                            @error('parent_id') 
                                <div class="text-danger mt-2 text-center small">{{ $message }}</div>
                            @enderror
                        </div>

                       
                        <div class="text-center">
                            <button type="submit" class="btn btn-create-category">
                                <i class="fas fa-plus-circle me-2"></i> Tạo mới danh mục con
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-lg ms-3">
                                <i class="fas fa-arrow-left me-2"></i> Quay lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
