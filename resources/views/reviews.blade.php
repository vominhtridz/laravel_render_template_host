@extends('layout.app')
@section('title', 'Đánh Giá Khách Hàng')
@section('content')
   <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Đánh Giá Khách Hàng</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form>
                <div class="mb-4">
                    <label for="customerName" class="block text-sm font-medium text-gray-700">Tên Khách Hàng</label>
                    <input type="text" id="customerName" placeholder="Nhập tên khách hàng" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" required>
                </div>

                <div class="mb-4">
                    <label for="customerEmail" class="block text-sm font-medium text-gray-700">Email Khách Hàng</label>
                    <input type="email" id="customerEmail" placeholder="Nhập email khách hàng" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" required>
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Đánh Giá</label>
                    <select id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" required>
                        <option value="">Chọn đánh giá</option>
                        <option value="1">1 - Kém</option>
                        <option value="2">2 - Trung Bình</option>
                        <option value="3">3 - Khá</option>
                        <option value="4">4 - Tốt</option>
                        <option value="5">5 - Xuất Sắc</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="review" class="block text-sm font-medium text-gray-700">Nhận Xét</label>
                    <textarea id="review" rows="4" placeholder="Nhập nhận xét của bạn" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" ></textarea>
                </div>

                <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    <i class="fas fa-paper-plane"></i> Gửi Đánh Giá
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Danh Sách Đánh Giá</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Tên Khách Hàng</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Đánh Giá</th>
                        <th class="py-2 px-4 border-b">Nhận Xét</th>
                        <th class="py-2 px-4 border-b">Ngày Gửi</th>
                        <th class="py-2 px-4 border-b">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if($reviews)
                    @foreach ( $reviews as $review)
                    <tr>
                        <td class="py-2 px-4 border-b whitespace-nowrap leading-5">
                            <a href="{{route('InforCustomers', ['id' => $review->customers->customer_id])}}" class="hover:!underline hover:!text-blue-500">
                            {{ $review->customers->name }}
                        </a>
                    </td>
                        <td class="py-2 px-4 border-b leading-5">{{ $review->customers->email }}</td>
                        <td class="py-2 px-4 border-b leading-5">{{ $review->rating }} Sao</td>
                        <td class="py-2 px-4 border-b leading-5">{{ $review->content }}</td>
                        <td class="py-2 px-4 border-b leading-5">{{ $review->created_at}}</td>
                        <td class="py-2 px-4 border-b leading-5">
                            <a href="#" class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i> Xem</a>
                            <a href="#" class="text-red-600 hover:text-red-800 ml-4"><i class="fas fa-trash"></i> Xóa</a>
                        </td>
                    </tr>
            
                    @endforeach
                    @else
                <td colspan="6" class="py-6 px-2  text-center whitespace-nowrap w-full">
                    <h2 class="text-center text-2xl flex items-center justify-center text-gray-700">chưa đơn hàng  nào</h2>
                </td>
               @endif
                    <!-- Thêm đánh giá khác tương tự -->
                </tbody>
            </table>
        </div>
    </div>

@endsection