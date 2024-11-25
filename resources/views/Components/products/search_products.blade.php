@extends('layout.app')
@section('title', 'Tìm Kiếm Sản Phẩm')

@section('content')
<div class="container mx-auto px-4">
    <div class="my-6">
        <h2 class="text-3xl font-semibold">Tìm Kiếm Sản Phẩm</h2>
    </div>

    <!-- Form Tìm Kiếm -->
    <form method="GET" action="{{ route('handleSearchProduct') }}" class="flex items-center gap-4 mb-6">
        <input type="text" name="keyword" placeholder="Từ khóa..." 
               value="{{ request('keyword') }}" 
               class="border rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <select name="category" class="border rounded-lg px-4 py-2">
            <option value="">-- Danh Mục --</option>
            <!-- Thêm danh mục từ database -->
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="color" class="border rounded-lg px-4 py-2">
            <option value="">-- Màu Sắc --</option>
            <option value="red" {{ request('color') == 'red' ? 'selected' : '' }}>Đỏ</option>
            <option value="blue" {{ request('color') == 'blue' ? 'selected' : '' }}>Xanh</option>
            <option value="green" {{ request('color') == 'green' ? 'selected' : '' }}>Lục</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Tìm Kiếm
        </button>
    </form>

    <!-- Danh Sách Sản Phẩm -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(isset($products))
        @forelse ($products as $product)
            <div class="border rounded-lg shadow-sm hover:shadow-lg overflow-hidden">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-blue-600 font-bold">{{ number_format($product->price) }} VND</span>
                        <span class="text-sm text-gray-500">Số lượng: {{ $product->quantity }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-600">
                Không tìm thấy sản phẩm phù hợp.
            </div>
        @endforelse
        @endif
    </div>
</div>
@endsection
