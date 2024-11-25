@extends('layout.app')
@section('title', 'Cập Nhật Giảm Giá')

@section('content')
<div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Cập Nhật Giảm Giá</h1>

    <!-- Error Messages -->
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
        <strong class="font-bold">Đã có lỗi xảy ra!</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('handleEditpromotion', ['id' => $promotion->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <!-- Tên Giảm Giá -->
        <div class="mb-3">
            <label for="name" class="block text-base font-medium text-gray-700">Tên Giảm Giá</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ $promotion->name }}" 
                required 
                placeholder="Nhập tên giảm giá..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mô Tả -->
        <div class="mb-3">
            <label for="description" class="block text-base font-medium text-gray-700">Mô Tả</label>
            <textarea 
                name="description" 
                id="description" 
                rows="4" 
                placeholder="Nhập mô tả giảm giá..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ $promotion->description }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Loại Giảm Giá -->
        <div class="mb-3">
            <label for="promotion_type" class="block text-base font-medium text-gray-700">Loại Giảm Giá</label>
            <input 
                type="text" 
                name="promotion_type" 
                id="promotion_type" 
                value="{{ $promotion->promotion_type }}" 
                required 
                placeholder="Nhập loại giảm giá..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('promotion_type') border-red-500 @enderror">
            @error('promotion_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Áp Dụng Cho -->
        <div class="mb-3">
            <label for="applicable_to" class="block text-base font-medium text-gray-700">Áp Dụng Cho</label>
            <input 
                type="text" 
                name="applicable_to" 
                id="applicable_to" 
                value="{{ $promotion->applicable_to }}" 
                required 
                placeholder="Nhập mục áp dụng..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('applicable_to') border-red-500 @enderror">
            @error('applicable_to')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Số Lần Sử Dụng -->
        <div class="mb-3">
            <label for="used_count" class="block text-base font-medium text-gray-700">Số Lần Sử Dụng</label>
            <input 
                type="number" 
                name="used_count" 
                id="used_count" 
                value="{{ $promotion->used_count }}" 
                required 
                placeholder="Nhập số lần sử dụng..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('used_count') border-red-500 @enderror">
            @error('used_count')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ngày Bắt Đầu -->
        <div class="mb-3">
            <label for="start_date" class="block text-base font-medium text-gray-700">Ngày Bắt Đầu</label>
            <input 
                type="date" 
                name="start_date" 
                id="start_date" 
                value="{{\Carbon\Carbon::parse($promotion->start_date)->format('Y-m-d')}}" 
                required 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('start_date') border-red-500 @enderror">
            @error('start_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ngày Kết Thúc -->
        <div class="mb-3">
            <label for="end_date" class="block text-base font-medium text-gray-700">Ngày Kết Thúc</label>
            <input 
                type="date" 
                name="end_date" 
                id="end_date" 
                value="{{ \Carbon\Carbon::parse($promotion->end_date)->format('Y-m-d') }}" 
                required 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-500 @enderror">
            @error('end_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Giá Trị Giảm -->
        <div class="mb-3">
            <label for="discount_value" class="block text-base font-medium text-gray-700">Giá Trị Giảm</label>
            <input 
                type="number" 
                name="discount_value" 
                id="discount_value" 
                value="{{ $promotion->discount_value }}" 
                required 
                placeholder="Nhập giá trị giảm..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('discount_value') border-red-500 @enderror">
            @error('discount_value')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Trạng Thái -->
        <div class="mb-3">
            <label for="status" class="block text-base font-medium text-gray-700">Trạng Thái</label>
            <select 
                name="status" 
                id="status" 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                <option value="hoat động" {{ $promotion->status == 'hoat động ' ? 'selected' : '' }}>hoạt động </option>
                <option value="không hoạt động" {{ $promotion->status == 'không hoạt động' ? 'selected' : '' }}>không hoạt động</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- S -->
        <div class="mb-3">
            <label for="category" class="block text-base font-medium text-gray-700">Danh Mục</label>
            <select 
                name="category" 
                id="category" 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}" {{ $category->name == $promotion->categories->name ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Sản Phẩm -->
        <div class="mb-3">
            <label for="product_id" class="block text-base font-medium text-gray-700">Sản Phẩm</label>
            <select 
                name="product_id" 
                id="product_id" 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Chọn Sản Phẩm</option>
                @foreach($products as $product)
                    <option value="{{ $product->name }}" {{ $product->name == $promotion->products->name ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Cập Nhật Giảm Giá
            </button>
        </div>
    </form>
</div>
@endsection
