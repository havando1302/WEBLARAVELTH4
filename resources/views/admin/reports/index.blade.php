@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">Báo cáo Bán hàng</h1>
        <button class="btn btn-success"><i class="fa-solid fa-file-excel me-2"></i>Xuất Excel</button>
    </div>

    <!-- Filters -->
    <div class="card-custom mb-4">
        <form class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Từ ngày</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Đến ngày</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-semibold">Loại báo cáo</label>
                <select class="form-select">
                    <option>Doanh thu theo thời gian</option>
                    <option>Sản phẩm bán chạy</option>
                    <option>Doanh thu theo danh mục</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Xem báo cáo</button>
            </div>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card-custom">
                <h5 class="fw-bold mb-4">Biểu đồ chi tiết doanh thu (Demo)</h5>
                <div style="height: 400px;">
                    <canvas id="salesReportChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesReportChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            datasets: [{
                label: 'Doanh thu',
                data: [120, 150, 180, 130, 200, 250, 220, 240, 210, 280, 310, 350],
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderRadius: 4
            }, {
                label: 'Chi phí',
                data: [80, 90, 110, 85, 120, 140, 130, 145, 125, 160, 180, 200],
                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#111827',
                    titleFont: { size: 13 },
                    bodyFont: { size: 14 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endsection
