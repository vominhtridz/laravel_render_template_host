@extends('layout.app')
@section('title', 'Cài Đặt Email')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-md p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-700">Cấu hình SMTP</h1>

    <!-- SMTP Configuration -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Cấu hình máy chủ gửi email</h2>
      <form id="smtpConfigForm" class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">SMTP Host</label>
          <input type="text" id="smtpHost" placeholder="smtp.gmail.com" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">SMTP Port</label>
          <input type="number" id="smtpPort" placeholder="587" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
          <input type="text" id="smtpUsername" placeholder="Email đăng nhập" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
          <input type="password" id="smtpPassword" placeholder="Mật khẩu" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Encryption</label>
          <select id="smtpEncryption" class="w-full p-2 border border-gray-300 rounded-md">
            <option value="TLS">TLS</option>
            <option value="SSL">SSL</option>
            <option value="None">Không mã hóa</option>
          </select>
        </div>
        <div>
          <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition mt-6">Lưu cấu hình</button>
        </div>
      </form>
    </div>

    <!-- Default Email -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Email mặc định</h2>
      <form id="defaultEmailForm">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Email mặc định</label>
          <input type="email" id="defaultEmail" placeholder="default@example.com" class="w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div class="mt-4">
          <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Lưu email</button>
        </div>
      </form>
    </div>

    <!-- Email Templates -->
    <div>
      <h2 class="text-xl font-medium text-gray-600 mb-4">Email mẫu</h2>
      <div class="space-y-4">
        <div class="bg-gray-100 p-4 rounded-md">
          <h3 class="text-lg font-semibold text-gray-700">Xác nhận đơn hàng</h3>
          <textarea id="orderConfirmationTemplate" rows="4" class="w-full mt-2 p-2 border border-gray-300 rounded-md">Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đang được xử lý.</textarea>
          <button type="button" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition mt-2">Lưu mẫu</button>
        </div>
        <div class="bg-gray-100 p-4 rounded-md">
          <h3 class="text-lg font-semibold text-gray-700">Quên mật khẩu</h3>
          <textarea id="passwordResetTemplate" rows="4" class="w-full mt-2 p-2 border border-gray-300 rounded-md">Vui lòng nhấp vào liên kết sau để đặt lại mật khẩu của bạn: [LINK]</textarea>
          <button type="button" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition mt-2">Lưu mẫu</button>
        </div>
      </div>
    </div>
  </div>
@endsection