@extends('layout.app')
@section('title', 'Danh Sách Khách Hàng')

@section('content')
<div class="container mx-auto px-4 mb-4">
    <!-- Quản lý Khách Hàng -->
        <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Khách Hàng</h2>


    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Hình Ảnh</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tên Khách Hàng</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Email</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Trạng Thái</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($customers && $customers->count() > 0)
                @foreach($customers as $customer)
                    <tr>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $customer->customer_id }}</td>
                        <td class="py-2 leading-5 h-36 w-36 px-2 text-center border-b">
                            <img src="{{ $customer->image }}" alt="{{ $customer->name }}" class="h-full w-full object-cover rounded-md mx-auto">
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">
                            <a class="hover:!underline hover:!text-blue-500 " href="/customers/infor/{{$customer->customer_id}}">
                                {{ $customer->name }}
                            </a>
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $customer->email }}</td>
                      
                        <td class="py-2 leading-5 px-2 text-center border-b">
                            <span class="{{ $customer->status == 'hoạt động' ? 'text-green-600' : 'text-red-600' }}">
                            hoạt động
                        </span>
                        </td>
                     
                        <td class="py-2 px-2 text-center border-b">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->
                                
                                <!-- Xóa -->
                                <form method="POST" action="{{ route('handleRemovecustomers', ['id' => $customer->customer_id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa Khách Hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu Khách Hàng</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
