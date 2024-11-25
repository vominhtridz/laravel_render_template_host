
@extends('layout.app')
@section('title', 'Cài Đặt Ngôn Ngữ')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-md p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-700">Cài đặt Ngôn ngữ</h1>

    <!-- Quản lý ngôn ngữ -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Quản lý ngôn ngữ</h2>
      <form id="languageForm" class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Tên ngôn ngữ</label>
          <input type="text" id="languageName" placeholder="Tiếng Việt" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Mã ngôn ngữ (ví dụ: vi, en)</label>
          <input type="text" id="languageCode" placeholder="vi" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="flex items-center justify-center space-x-4">
          <button type="button" id="addLanguageBtn" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">Thêm</button>
          <button type="button" id="updateLanguageBtn" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition hidden">Cập nhật</button>
        </div>
      </form>
    </div>

    <!-- Danh sách ngôn ngữ -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Danh sách ngôn ngữ</h2>
      <table class="w-full border border-gray-300 rounded-md">
        <thead class="bg-gray-100 text-gray-600">
          <tr>
            <th class="p-2 text-left">Tên ngôn ngữ</th>
            <th class="p-2 text-left">Mã ngôn ngữ</th>
            <th class="p-2 text-center">Hành động</th>
          </tr>
        </thead>
        <tbody id="languageList" class="text-gray-700">
          <!-- Dữ liệu sẽ được thêm bằng JavaScript -->
        </tbody>
      </table>
    </div>

    <!-- Tùy chỉnh bản dịch -->
    <div>
      <h2 class="text-xl font-medium text-gray-600 mb-4">Tùy chỉnh bản dịch</h2>
      <div id="translationSettings" class="space-y-4">
        <!-- Các trường bản dịch sẽ hiển thị tại đây -->
      </div>
    </div>
  </div>
@endsection