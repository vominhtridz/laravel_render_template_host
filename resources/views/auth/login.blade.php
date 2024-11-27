<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
   @vite('resources/js/app.js')
@vite('resources/css/app.css')

</head>

<body >
  <!-- message global -->
  @include('config.configJsToast')
    <div class="bg-gray-50 font-[sans-serif]">
        
      <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
          <div class="p-8 rounded-2xl bg-white shadow">
            <h2 class="text-gray-800 text-center text-2xl font-bold">Đăng Nhập</h2>
          
            <form id="loginform" autocomplete="off" class="mt-8 space-y-4" method="post" action="{{route('login')}}">
        
              @csrf
            <p name="error-text" class="error-text px-4 py-2 bg-red-50 hidden font-bold text-red-500 text-lg"></p>  
              <div class="">
                <label class="text-gray-800 text-sm mb-2 block">Email</label>
                <div class="relative flex items-center">
                  <input name="email"  value="{{old('email')}}" type="email" required class="w-full text-gray-800 text-sm border border-gray-300 px-3 py-2.5 rounded-md outline-blue-600" placeholder="Nhập tên người dùng.." />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                    <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                  </svg>
                </div>
              </div>

              <div class="relative">
                <label class="text-gray-800 text-sm mb-2 block">Mật khẩu</label>
                <div class="relative flex items-center">
                  <input id="password"  value="{{old('password')}}"  name="password" type="password" required class="w-full text-gray-800 text-sm border border-gray-300 px-3 py-2.5 rounded-md outline-blue-600" placeholder="Nhập mật khẩu..." />
                  <svg id="passwordeye" xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-5 h-5 absolute right-4 top-3  cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg>
              <svg id="password_no_eye" class="w-5 h-5 absolute right-4 top-3 hidden  cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"/></svg>

                </div>
              </div>

              <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                  <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                  <label for="remember_me" class="ml-3 block text-sm text-gray-800">
                    Nhớ mật khẩu
                  </label>
                </div>
                <div class="text-sm">
                  <a href="{{route('forgot.password')}}" class="text-blue-600 hover:underline font-semibold">
                    Quên mật khẩu
                  </a>
                </div>
              </div>

              <div class="!mt-8">
                <button type="submit" id="login" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  Đăng Nhập
                </button>
              </div>
              <p class="text-gray-800 text-sm !mt-8 text-center">Bạn Chưa có tài khoản? <a href="/register" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Đăng kí ở đây</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>

@include('config.showpwd')
</html>