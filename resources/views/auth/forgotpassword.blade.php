<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/js/app.js')
@vite('resources/css/app.css')

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
    <title>Quên mật khẩu</title>
</head>
<body>
  @include('config.configJsToast')

    <section class="bg-gray-50 ">
  <div class="flex flex-col items-center relative justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
     <div class="flex relative">
       <a href="{{route('login')}}" class="no-underline hover:bg-blue-600 right-[11.5rem] whitespace-nowrap absolute text-left flex h-9  items-center px-1.5 py-1 text-white bg-blue-500 rounded-md shadow">
         <svg  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="currentColor" fillRule="evenodd" stroke="currentColor" strokeLinejoin="round" stroke-width="4" d="M44 40.836q-7.34-8.96-13.036-10.168t-10.846-.365V41L4 23.545L20.118 7v10.167q9.523.075 16.192 6.833q6.668 6.758 7.69 16.836Z" clipRule="evenodd"/></svg>
         <p class="px-2 underline-none my-auto no-underline">Đăng Nhập</p>
        </a>
       <h2 class=" mb-6  text-2xl font-semibold text-gray-800">
         Quên Mật Khẩu
      </h2>
     </div>
      <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md  sm:p-8">
         
          <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="{{route('send.Link.Verify.Email')}}" method="post">
          @csrf
          @method('post')
              <div>
                  <label for="email" class=" block mb-2 text-base font-medium text-gray-900"> Email</label>
                <input name="email"  value="{{old('email')}}" type="email" required class="w-full text-gray-800 text-sm border border-gray-300 px-3 py-2.5 rounded-md outline-blue-600" placeholder="Nhập Email.." />

              </div>
            
             <button type="submit" id="login" class="w-full py-3 px-3 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  Xác thực email
                </button>
        </form>
      </div>
  </div>
</section>
</body>
</html>