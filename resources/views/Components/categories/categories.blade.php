@extends('layout.app')
@section('title', 'Danh Sách Danh Mục')

@section('content')
<div class="container mx-auto px-4">
    <!-- Quản lý Danh Mục -->
    <div class="flex justify-between items-center my-6">
        <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Danh Mục</h2>
        <a href="{{ route('Add_category') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
            <i class="fas fa-plus-circle"></i> Thêm Danh Mục
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Hình Ảnh</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tên Danh Mục</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Mô Tả</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Slug</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($categories && $categories->count() > 0)
                @foreach($categories as $category)
                    <tr>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $category->id }}</td>
                        <td class="py-2 leading-5 h-28 min-w-20 px-2 text-center border-b">
                            <img src="{{ $category->image }}" alt="{{ $category->image }}" class="h-full w-full object-cover rounded-md mx-auto">
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $category->name }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b"> @php
                                echo Str::limit($category->description, 100);
                            @endphp </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $category->slug }}</td>
                        <td class="py-2 px-2 text-center border-b">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->
                                <a href="{{ route('handleEditCategories', ['id' => $category->id]) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <!-- Xóa -->
                                <form method="POST" action="{{ route('handleRemoveCategories', ['id' => $category->id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?')">
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
                    <td colspan="5" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu danh mục</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
