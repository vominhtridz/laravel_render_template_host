@extends('layout.app')
@section('title', 'Thêm Phí Vận Chuyển')

@section('content')
<div class="w-full p-4 mx-auto mb-4 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Thêm Phí Vận Chuyển</h1>

    <form action="{{route('handleAddshipfee')}}" method="POST">
        @csrf

        <!-- Phí Vận Chuyển -->
        <div class="mb-4">
            <label for="shipping_fee" class="block text-sm font-medium text-gray-700">Phí Vận Chuyển</label>
            <input 
                type="number" 
                name="shipping_fee" 
                id="shipping_fee" 
                value="{{ old('shipping_fee') }}" 
                required 
                placeholder="Nhập phí vận chuyển..." 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <span class="text-sm text-red-500">Lưu ý: ví dụ theo tỉnh có phí 5 nghìn là 5000</span>
                @error('shipping_fee')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Khu Vực Vận Chuyển -->
       <div class="mb-4">
            <label for="shipfee_type" class="block text-sm font-medium text-gray-700">Khu Vực Vận Chuyển</label>
            <select 
                name="shipfee_type" 
                id="shipfee_type" 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="nội tỉnh" {{ old('shipfee_type') == 'nội tỉnh' ? 'selected' : '' }}>nội tỉnh</option>
                <option value="liên tỉnh" {{ old('shipfee_type') == 'liên tỉnh' ? 'selected' : '' }}>liên tỉnh</option>
                <option value="vùng xa" {{ old('shipfee_type') == 'vùng xa' ? 'selected' : '' }}>vùng xa</option>
            </select>
            @error('shipfee_type')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
      

        <!-- Miễn Phí Vận Chuyển -->
        <div class="mb-4 flex items-center">
            <input 
                type="checkbox" 
                name="is_free_shipping" 
                id="is_free_shipping" 
                {{ old('is_free_shipping') ? 'checked' : '' }} 
                class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
            <label for="is_free_shipping" class="ml-2 text-sm font-medium text-gray-700">Miễn Phí Vận Chuyển</label>
        </div>

        <!-- Giảm Giá -->
        <div class="mb-4">
            <label for="discount_amount" class="block text-sm font-medium text-gray-700">Số Tiền Giảm Giá</label>
            <input 
                type="number" 
                name="discount_amount" 
                id="discount_amount" 
                value="{{ old('discount_amount') }}" 
                placeholder="Nhập số tiền giảm giá nếu có..." 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('discount_amount')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Trạng Thái -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select 
                name="status" 
                id="status" 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="hoạt động" {{ old('status') == 'hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                <option value="không hoạt động" {{ old('status') == 'không hoạt động' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mã Đơn Hàng -->
   

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Thêm Phí Vận Chuyển
            </button>
        </div>
    </form>
</div>
@endsection
