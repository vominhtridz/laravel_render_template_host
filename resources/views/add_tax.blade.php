@extends('layout.app')
@section('title', 'Thêm Thuế')

@section('content')
<div class=" mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Thêm Thuế</h1>

    <form action="{{ route('handleAddTax') }}" method="POST">
        @csrf

        <!-- Tên Thuế -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên Thuế</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                required
                placeholder="Nhập tên thuế..." 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tỷ lệ Thuế -->
        <div class="mb-4">
            <label for="tax_rate" class="block text-sm font-medium text-gray-700">Tỷ lệ Thuế (%)</label>
            <input 
                type="number" 
                name="tax_rate" 
                id="tax_rate" 
                value="{{ old('tax_rate') }}" 
                required
                placeholder="Nhập tỷ lệ thuế" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tax_rate') border-red-500 @enderror">
            @error('tax_rate')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mô tả -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
            <textarea 
                name="description" 
                id="description" 
                rows="3" 
                placeholder="Nhập mô tả về thuế..." 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    <div class="mb-4">
        <label for="currency" class="block text-sm font-medium text-gray-700">Tiền Tệ</label>
        <select 
            name="currency" 
            id="currency" 
            class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="VND" {{ old('currency') == 'VND' ? 'selected' : '' }}>VND</option>
            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
        </select>
        
        <!-- Hiển thị lỗi nếu có -->
        @if ($errors->has('currency'))
            <p class="text-red-500 text-sm mt-2">{{ $errors->first('currency') }}</p>
        @endif
    </div>
     <div class="mb-4">
                <label for="applicable_to" class="block text-sm font-medium text-gray-700">Áp dụng cho</label>
                <select 
                    name="applicable_to" 
                    id="applicable_to" 
                    class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="all" {{ old('applicable_to') == 'all' ? 'selected' : '' }}>Tất cả</option>
                    <option value="business" {{ old('applicable_to') == 'business' ? 'selected' : '' }}>Doanh nghiệp</option>
                    <option value="individual" {{ old('applicable_to') == 'individual' ? 'selected' : '' }}>Cá nhân</option>
                </select>
                @error('applicable_to')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
        <!-- Loại Thuế -->
        <div class="mb-4">
            <label for="tax_type" class="block text-sm font-medium text-gray-700">Loại Thuế</label>
            <select 
                name="tax_type" 
                id="tax_type" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tax_type') border-red-500 @enderror">
                <option value="VAT" {{ old('tax_type') == 'VAT' ? 'selected' : '' }}>VAT</option>
                <option value="Income" {{ old('tax_type') == 'Income' ? 'selected' : '' }}>Thuế thu nhập</option>
                <option value="Corporate" {{ old('tax_type') == 'Corporate' ? 'selected' : '' }}>Thuế doanh nghiệp</option>
            </select>
            @error('tax_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ngày Bắt Đầu -->
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Ngày Bắt Đầu</label>
            <input 
                type="date" 
                name="start_date" 
                id="start_date" 
                value="{{ old('start_date') }}" 
                required
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('start_date') border-red-500 @enderror">
            @error('start_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ngày Kết Thúc -->
        <div class="mb-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Ngày Kết Thúc</label>
            <input 
                type="date" 
                name="end_date" 
                id="end_date" 
                value="{{ old('end_date') }}" 
                
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-500 @enderror">
            @error('end_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Trạng thái -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select 
                name="status" 
                id="status" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                <option value="hoạt động" {{ old('status') == "hoạt động" ? 'selected' : '' }}>Hoạt động</option>
                <option value="không hoạt động" {{ old('status') == "không hoạt động" ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
               Thêm Thuế
            </button>
        </div>
    </form>
</div>
@endsection
