@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">Quản lý Khuyến mãi</h1>
        <button class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Tạo mã mới</button>
    </div>

    <div class="card-custom mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Tìm kiếm mã khuyến mãi...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Đang diễn ra</option>
                    <option value="expired">Đã hết hạn</option>
                    <option value="upcoming">Sắp diễn ra</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-light w-100"><i class="fa-solid fa-filter me-2"></i>Lọc</button>
            </div>
        </div>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã CODE</th>
                        <th>Tên chương trình</th>
                        <th>Giảm giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-light text-dark border font-monospace">SUMMER20</span></td>
                        <td>Sale Chào Hè</td>
                        <td class="text-success fw-bold">-20%</td>
                        <td>01/06/2024</td>
                        <td>30/06/2024</td>
                        <td><span class="badge bg-success-subtle text-success">Đang diễn ra</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark border font-monospace">FREESHIP</span></td>
                        <td>Miễn phí vận chuyển</td>
                        <td class="text-primary fw-bold">Freeship</td>
                        <td>15/05/2024</td>
                        <td>15/12/2024</td>
                        <td><span class="badge bg-success-subtle text-success">Đang diễn ra</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark border font-monospace">BLACKFRIDAY</span></td>
                        <td>Siêu Sale Black Friday</td>
                        <td class="text-success fw-bold">-50%</td>
                        <td>24/11/2023</td>
                        <td>26/11/2023</td>
                        <td><span class="badge bg-secondary-subtle text-secondary">Đã hết hạn</span></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
