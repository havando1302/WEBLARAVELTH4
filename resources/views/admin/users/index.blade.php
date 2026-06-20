@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">Quản lý Tài khoản</h1>
        <button class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Thêm tài khoản</button>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=random" class="rounded-circle me-2" width="32" height="32" alt="">
                                <span>Admin User</span>
                            </div>
                        </td>
                        <td>admin@example.com</td>
                        <td><span class="badge bg-danger-subtle text-danger">Quản trị viên</span></td>
                        <td><span class="badge bg-success-subtle text-success">Hoạt động</span></td>
                        <td>20/10/2023</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="rounded-circle me-2" width="32" height="32" alt="">
                                <span>John Doe</span>
                            </div>
                        </td>
                        <td>johndoe@example.com</td>
                        <td><span class="badge bg-secondary-subtle text-secondary">Khách hàng</span></td>
                        <td><span class="badge bg-success-subtle text-success">Hoạt động</span></td>
                        <td>15/11/2023</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-light"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Placeholder -->
        <nav class="mt-4 d-flex justify-content-end">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Sau</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
