@extends('layout.app')
@section('title', 'Thông Tin Khách Hàng')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center mb-6">Thông Tin Khách Hàng</h2>
  <a href="{{ route('getAll_Customer') }}" class="bg-green-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-green-700">
     Quay Về
        </a>
        <div class="grid grid-cols-1 md:grid-cols-2 ">
            <!-- Customer Image -->
            <div class="flex justify-center items-center">
                <img src="{{ $customer->image }}" alt="Customer Image" class="w-56 h-56 rounded-full object-cover shadow-lg">
            </div>

            <!-- Customer Details -->
            <div>
                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Họ và Tên</label>
                    <p class="mt-1 text-gray-900">{{ $customer->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-gray-900">{{ $customer->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Số Điện Thoại</label>
                    <p class="mt-1 text-gray-900">{{ $customer->phonenumber }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Địa Chỉ</label>
                    <p class="mt-1 text-gray-900">{{ $customer->address }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Mã Bưu Chính</label>
                    <p class="mt-1 text-gray-900">{{ $customer->zip_code }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Trạng Thái</label>
                    <p class="mt-1 text-gray-900">{{ $customer->state }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-base font-medium text-gray-700">Mật Khẩu</label>
                    <p class="mt-1 text-gray-900">{{ $customer->password }}</p>
                </div>
            </div>
        </div>

      
    </div>
</div>
@endsection
