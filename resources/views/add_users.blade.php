 @extends('layout.app')
@section('title', 'Thêm Người Dùng')

@section('content')
<div class=" mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-center mb-6">Thêm Người Dùng</h1>

    <form action="{{ route('handleAddUser') }}" method="POST">
        @csrf
        <!-- Tên Người Dùng -->
        <div class="mb-3">
            <label for="name" class="block text-base font-medium text-gray-700">Tên Người Dùng</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                required
                placeholder="Nhập tên Người Dùng..." 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="block text-base font-medium text-gray-700">Email </label>
            <input 
                type="text" 
                name="email" 
                id="email" 
                value="{{ old('email') }}" 
                required
                placeholder="Nhập Email Người Dùng..." 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="block text-base font-medium text-gray-700">Mật Khẩu</label>
            <input 
                type="text" 
                name="password" 
                id="password" 
                value="{{ old('password') }}" 
                required
                placeholder="Nhập Mật Khẩu..." 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Loại Người Dùng -->
        <div class="mb-3">
            <label for="role" class="block text-base font-medium text-gray-700">Vai Trò</label>
            <select 
                name="role" 
                id="role" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tax_type') border-red-500 @enderror">
                <option value="viewer" {{ old('role') == 'viewer' ? 'selected' : '' }}>Người dùng</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản Lý</option>
                <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Người Sửa</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="status" class="block text-base font-medium text-gray-700">Trạng Thái</label>
            <select 
                name="status" 
                id="status" 
                class="mt-1 px-4 py-2 block w-full border  rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                <option value="hoạt động" {{ old('status') == "hoạt động" ? 'selected' : '' }}>Hoạt động</option>
                <option value="không hoạt động" {{ old('status') == "không hoạt động" ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nút Submit -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
               Thêm Người Dùng
            </button>
        </div>
    </form>
</div>
@endsection 