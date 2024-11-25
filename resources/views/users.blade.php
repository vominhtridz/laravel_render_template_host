
@extends('layout.app')
@section('title', 'Danh Sách Người dùng')

@section('content')
<div class="container mx-auto px-4 ">
    <!-- Quản lý Người Dùng-->
<div class="flex justify-between items-center my-6">
            <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Người Dùng</h2>
            <a href="{{ route('Add_Users') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i> Thêm Người Dùng
            </a>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-2 whitespace-nowrap border-b">ID </th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Tên </th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Email</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Vai Trò</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Ngày Đăng Nhập</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Xác Thực Email</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Trạng Thái</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @if($users && $users->count() > 0)
            @foreach($users as $user)
                <tr>
                    <td class="py-2 px-2 text-center border-b">{{ $user->id }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $user->name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $user->email }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $user->roles->first()?->name ?? 'Chưa có Vai Trò' }}</td>
                    <td class="py-2 px-2 text-center border-b">{{\Carbon\Carbon::parse($user->last_login_at)->format('Y-m-d')}}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $user->is_verified ? 'Đã Xác Thực':'Chưa Xác Thực' }}</td>
                    <td class="py-2 px-2 text-center border-b">
                        <span class="{{ $user->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $user->status  }}
                        </span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                        <div class="flex items-center justify-center">
                            <!-- Chỉnh sửa -->
                            <a href="{{ route('EditUser', $user->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <!-- Xóa -->
                            <form method="POST" action="{{ route('handleRemoveUser', $user->id) }}" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
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
                <td colspan="13" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu Người Dùng</td>
            </tr>
        @endif
    </tbody>
</table>

  </div>
@endsection