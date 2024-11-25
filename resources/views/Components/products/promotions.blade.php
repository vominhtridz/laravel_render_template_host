@extends('layout.app')
@section('title', 'Danh Sách Giảm giá')

@section('content')
<div class="container mx-auto px-4">
    <!-- Quản lý Giảm giá -->
    <div class="flex justify-between items-center my-6">
        <h2 class="text-3xl font-semibold">Danh Sách Giảm gia</h2>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tên Giảm Giá</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Mô Tả</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Bắt đầu </th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">kết thúc</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Giá trị</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Status</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Cho Sản Phẩm</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Cho Danh Mục</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($promotions && $promotions->count() > 0)
                @foreach($promotions as $promotion)
                    <tr>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $promotion->id }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $promotion->name }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">@php
                        echo str_replace('"', '', (Str::limit($promotion->description, 100)));
                        @endphp </td>
                            <td class="py-2 leading-5 px-2 text-center border-b">{{  \Carbon\Carbon::parse($promotion->start_date)->format('Y-m-d') }} </td>
                            <td class="py-2 leading-5 px-2 text-center border-b">{{ \Carbon\Carbon::parse($promotion->end_date)->format('Y-m-d') }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{$promotion->discount_value}}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $promotion->status }}</td>
                       
                        <td class="py-2 px-2 text-center border-b">
                           {{ $promotion->categories->name }}
                        </td>
                         <td class="py-2 px-2 text-center border-b">
                           {{ $promotion->products->name }}
                        </td>
                        <td class="py-2 px-2 text-center border-b">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->
                                <a href="{{ route('handleEditpromotion',['id'=> $promotion->id]) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <!-- Xóa -->
                                <form method="POST" action="{{ route('handleRemovepromotion',['id'=> $promotion->id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa Giảm giá này?')">
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
                    <td colspan="9" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu Giảm giá</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
