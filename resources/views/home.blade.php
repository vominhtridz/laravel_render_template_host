@extends('layout.app')
@section('title', 'Bảng điều khiển')

@section('content')
 <div class="container mx-auto px-4 pb-8 ">
        <h1 class="text-3xl font-bold mb-6">Bảng Điều Khiển</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6 text-gray-700">
            <a href="/products" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-box"></i> Tổng Sản Phẩm</h2>
                <p class="text-2xl font-bold ">{{count($products)}}</p>
            </a>
            <a href="/orders" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-shopping-cart"></i> Tổng  Đơn Hàng</h2>
                <p class="text-2xl font-bold ">{{count($orders)}}</p>
            </a>
             <a href="/products" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-shopping-cart"></i> Sản Phẩm Bán Chạy</h2>
                <p class="text-2xl font-bold ">25</p>
            </a>
            <a href="/customers/getAll" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-users"></i> Khách hàng mới</h2>
                <p class="text-2xl font-bold ">1</p>
            </a>
            <a href="/customers/getAll" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-users"></i> Khách Hàng</h2>
                <p class="text-2xl font-bold ">{{count($customers)}}</p>
            </a>
             <a href="/users" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-users"></i> người dùng</h2>
                <p class="text-2xl font-bold ">{{count($users)}}</p>
            </a>
             <a href="/report/revenue" class="bg-white p-3 rounded-lg shadow-sm border hover:!underline text-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-2 "><i class="fas fa-chart-line"></i> Doanh thu</h2>
                <p class="text-2xl font-bold ">100,000,000</p>
            </a>
        </div>

        <div class="bg-white p-3 rounded-lg shadow-sm border text-center tracking-wide border-gray-50 text-gray-700">
            <h2 class="text-xl font-semibold mb-4"><i class="fas fa-chart-line"></i> Doanh Thu</h2>
            <canvas id="revenueChart" height="400"></canvas>
            <!-- Biểu đồ có thể thêm bằng Chart.js hoặc thư viện tương tự -->
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6 text-gray-700">
            <div class="bg-white p-3 rounded-lg shadow-sm bordertext-center tracking-wide border-gray-50">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-shopping-basket"></i> Đơn Hàng Mới Nhất</h2>
                <ul>
                    @if($orders_news)
                    @foreach($orders_news as $order)
                    <li class="border-b py-2 hover:!underline">
                        <a href="/orders">
                            <strong>{{$order->order_id}}</strong> - {{$order->customers->name}} - {{ number_format($order->total_amount, 0, ',', '.')}} VNĐ
                        </a>
                    </li>
                    @endforeach
                    @endif
                    
                    <!-- Thêm đơn hàng khác -->
                </ul>
            </div>

            <div class="bg-white p-3 rounded-lg shadow-sm border tracking-wide border-gray-50 text-gray-700">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-cog"></i> Cài Đặt Hệ Thống</h2>
                <ul>
                    <a href="/users">
                        <li class="hover:!underline"><i class="fas fa-user-cog"></i> Quản lý người dùng</li>
                    </a>
                    <a href="/settings">
                        <li class="hover:!underline"><i class="fas fa-sliders-h"></i> Tùy chọn chung</li>
                    </a>
                    <a href="/report/revenue">
                        <li class="hover:!underline"><i class="fas fa-chart-pie"></i> Thống kê</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mã JavaScript để hiển thị biểu đồ (sử dụng Chart.js)
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
                datasets: [{
                    label: 'Doanh Thu',
                    data: [100000, 200000, 150000, 300000, 250000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection