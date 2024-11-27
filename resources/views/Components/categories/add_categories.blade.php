@extends('layout.app')
@section('title', 'Thêm Danh Mục')

@section('content')
<div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Thêm Danh Mục</h1>
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
    <form action="{{ route('handleAddcategories')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên Danh Mục -->
        <div class="mb-3">
            <label for="name" class="block text-base font-medium text-gray-700">Tên Danh Mục</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                required
                placeholder="Nhập tên Danh Mục..." 
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
                placeholder="Nhập mô tả Danh Mục..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description')}}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


     

        <!-- Ảnh Danh Mục -->
        <div class="mb-3">
            <label for="image" class="block text-base font-medium text-gray-700">Ảnh Danh Mục</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror">
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
 <div class="mb-3">
            <label for="slug" class="block text-base font-medium text-gray-700">SEO</label>
            <input 
                type="text" 
                name="slug" 
                id="slug" 
                value="{{ old('slug') }}" 
                required
                placeholder="Nhập slug..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Thêm Danh Mục
            </button>
        </div>
    </form>
</div>
@endsection
