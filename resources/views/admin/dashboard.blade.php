@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <!-- Top Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-custom h-100 position-relative border-0 shadow-sm" style="border-radius: 12px; border-bottom: 3px solid #10b981 !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Tổng Doanh Thu</h6>
                    <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1">+15%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="mb-0 fw-bold">{{ number_format($totalRevenue ?? 0) }} đ</h3>
                    <div class="text-success"><i class="fa-solid fa-chart-line fs-4"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-custom h-100 position-relative border-0 shadow-sm" style="border-radius: 12px; border-bottom: 3px solid #f59e0b !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Tổng Đơn Hàng</h6>
                    <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1">-2%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="mb-0 fw-bold">{{ $totalOrders ?? 0 }}</h3>
                    <div class="text-warning"><i class="fa-solid fa-cart-shopping fs-4"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-custom h-100 position-relative border-0 shadow-sm" style="border-radius: 12px; border-bottom: 3px solid #3b82f6 !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Khách Hàng</h6>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1">+5%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="mb-0 fw-bold">{{ $totalCustomers ?? 0 }}</h3>
                    <div class="text-primary"><i class="fa-solid fa-users fs-4"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card-custom h-100 position-relative border-0 shadow-sm" style="border-radius: 12px; border-bottom: 3px solid #ef4444 !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted mb-0 fw-semibold" style="font-size: 0.85rem;">Sản Phẩm</h6>
                    <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1">+12%</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="mb-0 fw-bold">{{ $totalProducts ?? 0 }}</h3>
                    <div class="text-danger"><i class="fa-solid fa-box-open fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart & Map Area -->
    <div class="row g-4 mb-4">
        <!-- Revenue Chart -->
        <div class="col-12 col-xl-8">
            <div class="card-custom h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Biểu đồ doanh thu</h5>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Tháng này
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Hôm nay</a></li>
                            <li><a class="dropdown-item" href="#">Tuần này</a></li>
                            <li><a class="dropdown-item" href="#">Năm nay</a></li>
                        </ul>
                    </div>
                </div>
                <div style="height: 350px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Regional Sales (Map placeholder) -->
        <div class="col-12 col-xl-4">
            <div class="card-custom h-100">
                <h5 class="fw-bold mb-4">Phân bổ doanh số</h5>
                
                <div class="d-flex flex-column gap-4">
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-muted" style="font-size: 0.9rem;">Hà Nội</span>
                            <span class="fw-bold">45%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-muted" style="font-size: 0.9rem;">TP. Hồ Chí Minh</span>
                            <span class="fw-bold">30%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 30%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-muted" style="font-size: 0.9rem;">Đà Nẵng</span>
                            <span class="fw-bold">15%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 15%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-muted" style="font-size: 0.9rem;">Khác</span>
                            <span class="fw-bold">10%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: 10%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <div class="d-flex justify-content-around">
                        <div class="text-center">
                            <div class="position-relative d-inline-block" style="width: 60px; height: 60px;">
                                <svg class="w-100 h-100" viewBox="0 0 36 36">
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3" />
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#3b82f6" stroke-width="3" stroke-dasharray="75, 100" />
                                </svg>
                                <div class="position-absolute top-50 start-50 translate-middle fw-bold" style="font-size: 0.75rem;">75%</div>
                            </div>
                            <div class="mt-2 text-muted" style="font-size: 0.8rem;">Khách mới</div>
                        </div>
                        <div class="text-center">
                            <div class="position-relative d-inline-block" style="width: 60px; height: 60px;">
                                <svg class="w-100 h-100" viewBox="0 0 36 36">
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="3" />
                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#10b981" stroke-width="3" stroke-dasharray="50, 100" />
                                </svg>
                                <div class="position-absolute top-50 start-50 translate-middle fw-bold" style="font-size: 0.75rem;">50%</div>
                            </div>
                            <div class="mt-2 text-muted" style="font-size: 0.8rem;">Tái mua</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Doanh thu',
                data: [65, 59, 80, 81, 56, 55, 40, 60, 75, 90, 85, 100],
                borderColor: '#3b82f6',
                backgroundColor: gradient,
                borderWidth: 2,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#3b82f6',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 14, weight: 'bold' },
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Tr VNĐ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#6b7280',
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#6b7280',
                        font: { size: 12 }
                    }
                }
            }
        }
    });
});
</script>
@endsection
