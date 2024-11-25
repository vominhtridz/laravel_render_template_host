@extends('layout.app')
@section('title', 'Danh Sách Banner')

@section('content')
<div class="container mx-auto px-4 mb-4">
    <!-- Quản lý Banner -->
    <div class="flex justify-between items-center my-6">
        <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Banner</h2>
        <a href="{{ route('Add_Banner') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
            <i class="fas fa-plus-circle"></i> Thêm Banner
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tên Banner</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Hình Ảnh</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Link URL</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Ngày Bắt Đầu</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Ngày Kết Thúc</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Trạng Thái</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Mô Tả</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Người Tạo</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Người Cập Nhật</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($banners && $banners->count() > 0)
                @foreach($banners as $banner)
                    <tr>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $banner->id }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $banner->name }}</td>
                        <td class="py-2 leading-5 h-28 min-w-[18rem] px-2 text-center border-b">
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->name }}" class="h-full w-full object-cover rounded-md mx-auto">
                        </td>
                        <td class="py-2 leading-5  text-center border-b">
                            <a href="{{ $banner->link_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                {{ Str::limit($banner->link_url, 30) }}
                            </a>
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ \Carbon\Carbon::parse($banner->start_date)->format('d-m-Y') }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ \Carbon\Carbon::parse($banner->end_date)->format('d-m-Y') }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">
                            <span class="{{ $banner->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($banner->status) }}
                            </span>
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">
                            @php
                                echo Str::limit($banner->description, 100);
                            @endphp
                        </td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $banner->created_by }}</td>
                        <td class="py-2 leading-5 px-2 text-center border-b">{{ $banner->updated_by }}</td>
                        <td class="py-2 px-2 text-center border-b">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->
                                <a href="{{ route('handleEditBanner', ['id' => $banner->id]) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <!-- Xóa -->
                                <form method="POST" action="{{ route('handleRemoveBanner', ['id' => $banner->id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa banner này?')">
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
                    <td colspan="11" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu Banner</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
