@extends('layout.app')
@section('title', 'Danh Sách Sản Phẩm')

@section('content')
<div class="container mx-auto px-4">
    <!-- Quản lý Sản Phẩm -->
    <div class="flex justify-between items-center my-6">
        <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Sản Phẩm</h2>
        <a href="{{ route('Add_Product') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
            <i class="fas fa-plus-circle"></i> Thêm Sản Phẩm
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tên Sản Phẩm</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Danh Mục</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Mô Tả</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Giá</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Số Lượng</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Hình Ảnh</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Màu Sắc</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($products && $products->count() > 0)
                @foreach($products as $product)
                    <tr>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $product->id }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $product->name }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $product->category->name ?? 'Không xác định' }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">@php
                        echo str_replace('"', '', (Str::limit($product->description, 100)));
                        @endphp </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $product->quantity }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded-md mx-auto">
                        </td>
                        <td class="py-2 px-2 text-center border-b">
                            <span class="inline-block w-6 h-6 leading-4 rounded-full " >{{ $product->color }}</span>
                        </td>
                        <td class="py-2 px-2 text-center border-b">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->
                                <a href="{{ route('handleEditProduct',['id'=> $product->id]) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <!-- Xóa -->
                                <form method="POST" action="{{ route('handleRemoveProduct',['id'=> $product->id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
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
                    <td colspan="9" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu sản phẩm</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
