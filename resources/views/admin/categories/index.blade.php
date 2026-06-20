@extends('layouts.app')

@section('content')
<style>
    .admin-categories-page {
        padding: 30px 0 80px;
        max-width: 700px;
        margin: 0 auto;
    }

    .admin-cat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .admin-cat-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    .admin-cat-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s;
    }

    .admin-cat-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(27, 42, 74, 0.3);
        color: white;
    }

    .cat-list {
        list-style: none;
        padding: 0;
        margin: 0;
        counter-reset: cat-counter;
    }

    .cat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        background: white;
        border: 1px solid #F3F4F6;
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        counter-increment: cat-counter;
    }

    .cat-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border-color: #E8C5A8;
        transform: translateX(4px);
    }

    .cat-item-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cat-item-number {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #FDF8F3, #F5E6D0);
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        color: #A67548;
    }

    .cat-item-number::before {
        content: counter(cat-counter);
    }

    .cat-item-name {
        font-weight: 600;
        font-size: 0.95rem;
        color: #1A1A1A;
    }

    .cat-item-actions {
        display: flex;
        gap: 8px;
    }

    .cat-btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 8px 14px;
        background: #FEF3C7;
        color: #92400E;
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .cat-btn-edit:hover {
        background: #F59E0B;
        color: white;
    }

    .cat-btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 8px 14px;
        background: #FEE2E2;
        color: #DC2626;
        border: none;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cat-btn-delete:hover {
        background: #DC2626;
        color: white;
    }

    .cat-empty {
        text-align: center;
        padding: 40px;
        color: #9CA3AF;
        background: white;
        border-radius: 12px;
        border: 1px solid #F3F4F6;
    }
</style>

<div class="admin-categories-page">
    <div class="admin-cat-header">
        <h1><i class="fa-solid fa-tags" style="color: #C8956C; margin-right: 8px;"></i> Danh Mục Sản Phẩm</h1>
        <a href="{{ route('admin.categories.create') }}" class="admin-cat-add-btn">
            <i class="fa-solid fa-plus"></i> Thêm danh mục
        </a>
    </div>

    @if(isset($mainCategory) && $mainCategory->children->count())
        <ul class="cat-list">
            @foreach($mainCategory->children as $category)
                <li class="cat-item">
                    <div class="cat-item-left">
                        <div class="cat-item-number"></div>
                        <span class="cat-item-name">{{ $category->name }}</span>
                    </div>
                    <div class="cat-item-actions">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="cat-btn-edit">
                            <i class="fa-solid fa-pen"></i> Sửa
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cat-btn-delete">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="cat-empty">
            <i class="fa-solid fa-folder-open" style="font-size: 2rem; margin-bottom: 12px; display: block; color: #D1D5DB;"></i>
            Không có danh mục nào.
        </div>
    @endif
</div>
@endsection
