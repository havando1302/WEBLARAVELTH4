@extends('layouts.app')

@section('content')
<style>
    /* Căn giữa nội dung chính của trang */
    .category-container {
        max-width: 600px;
        margin: 0 auto; /* căn giữa ngang */
        padding: 20px;
    }

    /* Danh sách danh mục */
    .list-group {
        counter-reset: category-counter; /* Khởi tạo bộ đếm */
        padding-left: 0;
        list-style: none;
    }

    /* Từng mục danh mục */
    .list-group-item {
        display: flex;
        justify-content: space-between; /* Tên và nút ở 2 đầu */
        align-items: center; /* căn giữa theo chiều dọc */
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
        position: relative;
    }

    /* Thứ tự số ở đầu từng mục */
    .list-group-item::before {
        counter-increment: category-counter;
        content: counter(category-counter) ". ";
        font-weight: bold;
        margin-right: 10px;
        color: #333;
        position: absolute;
        left: 15px;
    }

    /* Phần tên danh mục căn lề trái, có khoảng cách bên trái do số thứ tự */
    .category-name {
        margin-left: 30px;
        flex-grow: 1; /* chiếm hết khoảng trống */
        font-size: 1.1rem;
    }

    /* Container chứa nút sửa xóa */
    .action-buttons {
        white-space: nowrap; /* tránh nút bị xuống dòng */
        display: flex;
        gap: 5px;
    }

    /* Button sửa và xóa */
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.85rem;
    }
</style>

<div class="category-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách danh mục sản phẩm</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Thêm danh mục sản phẩm
        </a>
    </div>

    {{-- Hiển thị danh sách danh mục con --}}
    @if(isset($mainCategory) && $mainCategory->children->count())
        <ul class="list-group">
            @foreach($mainCategory->children as $category)
                <li class="list-group-item">
                    <span class="category-name">{{ $category->name }}</span>

                    <div class="action-buttons">
                        {{-- Nút sửa --}}
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i> Sửa
                        </a>

                        {{-- Form xóa --}}
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>Không có danh mục nào.</p>
    @endif
</div>
@endsection
