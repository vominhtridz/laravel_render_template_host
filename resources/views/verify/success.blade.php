<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6 text-center">
        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5 4v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6a9 9 0 1118 0z"></path>
        </svg>
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Gửi Yêu Cầu Xác Thực Email Thành công.</h1>
        <p class="text-gray-600 mb-6">Vui lòng kiểm tra đường dẫn Email <strong>{{$email}}</strong> của bạn để thay đổi mật khẩu.</p>
        
        <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
            Đăng Nhập
        </a>
    </div>
</body>
</html>
