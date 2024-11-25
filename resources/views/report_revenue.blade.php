@extends('layout.app')
@section('title', 'Báo Cáo Doanh Thu')
@section('content')
<div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Báo Cáo Doanh Thu</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form>
                <div class="mb-4">
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Ngày Bắt Đầu</label>
                    <input type="date" id="startDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" required>
                </div>

                <div class="mb-4">
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Ngày Kết Thúc</label>
                    <input type="date" id="endDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" required>
                </div>

                <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    <i class="fas fa-search"></i> Xem Báo Cáo
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Tổng Quan Doanh Thu</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Ngày</th>
                        <th class="py-2 px-4 border-b">Doanh Thu</th>
                        <th class="py-2 px-4 border-b">Số Đơn Hàng</th>
                        <th class="py-2 px-4 border-b">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">01/10/2024</td>
                        <td class="py-2 px-4 border-b">5,000,000 VNĐ</td>
                        <td class="py-2 px-4 border-b">50</td>
                        <td class="py-2 px-4 border-b">
                            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i> Chi Tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">02/10/2024</td>
                        <td class="py-2 px-4 border-b">7,000,000 VNĐ</td>
                        <td class="py-2 px-4 border-b">70</td>
                        <td class="py-2 px-4 border-b">
                            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i> Chi Tiết</a>
                        </td>
                    </tr>
                    <!-- Thêm báo cáo doanh thu khác tương tự -->
                </tbody>
            </table>

            <div class="mt-4">
                <h3 class="text-lg font-semibold">Tổng Doanh Thu: 12,000,000 VNĐ</h3>
            </div>
        </div>
    </div>
@endsection