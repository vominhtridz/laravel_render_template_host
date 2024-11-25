@extends('layout.app')
@section('title', 'Sửa Thuế')

@section('content')
<div class=" mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Sửa Thuế</h1>

    <form action="{{ route('handleEditTax', $tax->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Tên Thuế -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên Thuế</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $tax->name) }}" 
                required
                placeholder="Nhập tên thuế..." 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
        <label for="currency" class="block text-sm font-medium text-gray-700">Tiền Tệ</label>
        <select 
            name="currency" 
            id="currency" 
            class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="VND" {{ $tax->currency == 'VND' ? 'selected' : '' }}>VND</option>
            <option value="USD" {{ $tax->currency == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="EUR" {{ $tax->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
        </select>
        
        <!-- Hiển thị lỗi nếu có -->
        @if ($errors->has('currency'))
            <p class="text-red-500 text-sm mt-2">{{ $errors->first('currency') }}</p>
        @endif
    </div>
    <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select 
                name="status" 
                id="status" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                <option value="hoạt động" {{ $tax->status == "hoạt động" ? 'selected' : '' }}>Hoạt động</option>
                <option value="không hoạt động" {{ $tax->status == "không hoạt động" ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
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
                value="{{ old('tax_rate', $tax->tax_rate) }}" 
                required
                placeholder="Nhập tỷ lệ thuế" 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('tax_rate')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $tax->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Loại Thuế -->
        <div class="mb-4">
            <label for="tax_type" class="block text-sm font-medium text-gray-700">Loại Thuế</label>
            <select 
                name="tax_type" 
                id="tax_type" 
                class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="VAT" {{ old('tax_type', $tax->tax_type) == 'VAT' ? 'selected' : '' }}>VAT</option>
                <option value="Income" {{ old('tax_type', $tax->tax_type) == 'Income' ? 'selected' : '' }}>Thuế thu nhập</option>
                <option value="Corporate" {{ old('tax_type', $tax->tax_type) == 'Corporate' ? 'selected' : '' }}>Thuế doanh nghiệp</option>
            </select>
            @error('tax_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Ngày bắt đầu -->
       <div class="mb-4">
    <label for="start_date" class="block text-sm font-medium text-gray-700">Ngày Bắt Đầu</label>
    <input 
        type="date" 
        name="start_date" 
        id="start_date" 
        value="{{ \Carbon\Carbon::parse($tax->start_date)->format('Y-m-d') }}"
        required
        class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    @error('start_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        <!-- Ngày kết thúc -->
        <div class="mb-4">
    <label for="end_date" class="block text-sm font-medium text-gray-700">Ngày Kết Thúc</label>
    <input 
        type="date" 
        name="end_date" 
        id="end_date" 
        value="{{ \Carbon\Carbon::parse($tax->end_date)->format('Y-m-d') }}"
        required
        class="mt-1 px-4 py-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
    @error('end_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Cập Nhật Thuế
            </button>
        </div>
    </form>
</div>
@endsection
