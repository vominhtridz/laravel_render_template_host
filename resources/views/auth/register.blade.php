<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
 @vite('resources/js/app.js')
@vite('resources/css/app.css')

</head>
@php 
$emailError = $errors->has('email')? 'outline-red-500 border-red-500':'text-gray-800  border-gray-300 outline-blue-500';
$nameErr = $errors->has('name')? 'outline-red-500 border-red-500':'text-gray-800  border-gray-300 outline-blue-500';
$PwdErr = $errors->has('password')? 'outline-red-500 border-red-500':'text-gray-800  border-gray-300 outline-blue-500';
$ConfirmPwdErr = $errors->has('password1')? 'outline-red-500 border-red-500':'text-gray-800  border-gray-300 outline-blue-500';
@endphp
<body class="bg-gray-100">
  <!-- message global  -->
  @include('config.configJsToast')
  <!-- body -->
     <div  class="flex flex-col justify-center font-[sans-serif] sm:h-screen p-4">
      <div   class="registerForm max-w-md w-full mx-auto border border-gray-300 rounded-2xl p-8">
        <div class="text-center text-2xl font-bold mb-4">
         Đăng kí
        </div>
        <form id="formregister" action="{{route('handle.register')}}" method="post" autocomplete="off" >
            @csrf
            @method('post')
            <div>
              <label class="text-gray-800 text-sm font-medium mb-2 block pt-1">Email</label>
              <input required  name="email"  value="{{old('email')}}" type="email" class="border text-gray-800  {{$emailError}} bg-white w-full text-sm px-3 py-2.5 rounded-md" placeholder="Nhập Email..." />
            @error('email')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            </div>
            <div>
              <label class="text-gray-800 text-sm font-medium mb-2 block pt-1">Họ và tên</label>
              <input required id="name"  value="{{old('name')}}" name="name" type="text" class="border text-gray-800  {{$nameErr}} bg-white w-full text-sm px-3 py-2.5 rounded-md" placeholder="Nhập họ và tên" />
             @error('name')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            </div>
        
            <div class="relative">
              <label class="text-gray-800 text-sm font-medium mb-2 block pt-1">Mật khẩu</label>
              <input required  value="{{old('password')}}" id="password" name="password" type="password" class="border text-gray-800  {{$PwdErr}} bg-white w-full text-sm px-3 py-2.5 rounded-md" placeholder="Nhập Mật khẩu" />
             <svg onclick="" id="passwordeye" xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 top-11 cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg>
              <svg id="password_no_eye" class="w-4 h-4 absolute right-4 top-11 hidden  cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"/></svg>
              @error('password')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            </div>
             <div class="relative">
              <label class="text-gray-800 text-sm font-medium mb-2 block pt-1">Xác Nhận Mật khẩu</label>
              <input required   value="{{old('password1')}}" id="password1" name="password1" type="password" class="border text-gray-800  {{$ConfirmPwdErr}} bg-white w-full text-sm px-3 py-2.5 rounded-md" placeholder="Nhập Mật khẩu" />
              <svg id="password1eye" xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 top-11  cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg>
              <svg id="password_no_eye1" class="w-4 h-4 absolute right-4 top-11 hidden  cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"/></svg>
              @error('password1')
            <span class="text-red-500">{{$message}}</span>
            @enderror
            </div>
          <button type="submit" class="w-full cursor-pointer mt-4 py-3 px-4 text-sm tracking-wider font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Đăng Kí</button>
          <p class="text-gray-800 text-sm font-medium mt-6 text-center">Bạn đã có tài khoản? 
            <a href="/login" class="text-blue-600 font-semibold hover:underline ml-1">Đăng nhập ở đây</a>
          </p>
        </form>
      </div>
</div>
</body>

@include('config.showpwd')
</html>