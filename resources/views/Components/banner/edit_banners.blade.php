@extends('layout.app')
@section('title', 'Cập Nhật Banner')

@section('content')
<div class="mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Cập Nhật Banner</h1>
    
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

    <form action="{{ route('handleEditBanner',['id'=>$banner->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
@method('put')
        <!-- Tên Banner -->
        <div class="mb-3">
            <label for="name" class="block text-base font-medium text-gray-700">Tên Banner</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ $banner->name }}" 
                required
                placeholder="Nhập tên banner..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Link URL -->
        <div class="mb-3">
            <label for="link_url" class="block text-base font-medium text-gray-700">Link URL</label>
            <input 
                type="url" 
                name="link_url" 
                id="link_url" 
                value="{{ $banner->link_url }}" 
                required
                placeholder="Nhập link banner..." 
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('link_url') border-red-500 @enderror">
            @error('link_url')
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
                value="{{ \Carbon\Carbon::parse($banner->start_date)->format('Y-m-d') }}" 
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
                value="{{ \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d')  }}" 
                required
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-500 @enderror">
            @error('end_date')
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
                <option value="hoạt động" {{ $banner->status == 'hoạt động' ? 'selected' : '' }}>Hoạt Động</option>
                <option value="không hoạt động" {{ $banner->status == 'không hoạt động' ? 'selected' : '' }}>Không Hoạt Động</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mô Tả -->
        <div class="mb-3">
            <label for="description" class="block text-base font-medium text-gray-700">Mô Tả</label>
            <textarea 
                name="description" 
                id="description" 
                placeholder="Nhập mô tả banner..." 
                rows="4"
                class="mt-1 px-4 py-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ $banner->description }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Hình Ảnh -->
        <div class="mb-3">
            <label for="image" class="block text-base font-medium text-gray-700">Hình Ảnh</label>
             <div class="mb-3">
                <img src="/{{ $banner->image_url }}" alt="Ảnh sản phẩm" class="w-32 h-32 object-cover mb-2">
            </div>
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

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Cập Nhật Banner
            </button>
        </div>
    </form>
</div>
@endsection
