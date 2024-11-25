@extends('layout.app')
@section('title', 'Thêm Sản Phẩm')

@section('content')
<div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Thêm Sản Phẩm</h1>
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

    <form action="{{ route('handleAddProduct') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên Sản Phẩm -->
        <div class="mb-3">
            <label for="name" class="block text-base font-medium text-gray-700">Tên Sản Phẩm</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                required
                placeholder="Nhập tên sản phẩm..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Danh Mục -->
        <div class="mb-3">
            <label for="category" class="block text-base font-medium text-gray-700">Danh Mục</label>
            <select 
                name="category" 
                id="category" 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mô Tả -->
        <div class="mb-3">
            <label for="description" class="block text-base font-medium text-gray-700">Mô Tả</label>
            <textarea 
                name="description" 
                id="description" 
                placeholder="Nhập mô tả sản phẩm..." 
                rows="4"
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label for="price" class="block text-base font-medium text-gray-700">Giá</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                value="{{ old('price') }}" 
                required
                placeholder="Nhập giá sản phẩm..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror">
            @error('price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Số Lượng -->
        <div class="mb-3">
            <label for="quantity" class="block text-base font-medium text-gray-700">Số Lượng</label>
            <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                value="{{ old('quantity') }}" 
                required
                placeholder="Nhập số lượng sản phẩm..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('quantity') border-red-500 @enderror">
            @error('quantity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Hình Ảnh -->
        <div class="mb-3">
            <label for="image" class="block text-base font-medium text-gray-700">Hình Ảnh</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                accept="image/*"
                class="mt-1 block w-full text-gray-700 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror">
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Màu Sắc -->
        <div class="mb-3">
            <label for="color" class="block text-base font-medium text-gray-700">Màu Sắc</label>
            <input 
                type="text" 
                name="color" 
                id="color" 
                value="{{ old('color') }}" 
                required
                placeholder="Nhập màu sắc sản phẩm..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror">
            @error('color')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Thêm Sản Phẩm
            </button>
        </div>
    </form>
</div>
@endsection
