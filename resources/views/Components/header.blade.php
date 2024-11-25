 <!-- Conditional statement -->
@php
$userImage = \App\Helpers\Helper::getProfile()->image === null ? '/images/usericon.png' : \App\Helpers\Helper::getProfile()->image;
$UserName = \App\Helpers\Helper::getProfile()->roles->first()->name;
$role;
if($UserName == 'admin'){
$role = 'Quản Trị Viên';
}
if($UserName == 'editor'){
$role = 'Biên Tập Viên';
}
if($UserName == 'viewer'){
$role = 'Người Xem';
}
@endphp

<header class="flex z-50 fixed top-0 left-0 right-0 items-center justify-between p-2.5 bg-gray-800 border-b shadow-sm">
  <a href="/" class="text-2xl ml-2 uppercase tracking-wide !text-gray-200 hover:!text-white font-bold">{{$role}}</a>
  
  <div class="flex items-center relative">
      <div class="text-2xl cursor-pointer mr-4">🔔</div>
      <div class="block relative">
          <img src="{{ $userImage }}" alt="User" class="w-10 h-10 rounded-full cursor-pointer" id="user-image">
          <div class="absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg hidden" id="options-dropdown">
              <a href="/settings" class="block no-underline hover:text-gray-900 hover:shadow  px-4 py-2 text-gray-800 hover:bg-gray-100 whitespace-nowrap">Cài đặt</a>
              <a href="/products" class="block no-underline  hover:text-gray-900 hover:shadow px-4 py-2 text-gray-800 hover:bg-gray-100 whitespace-nowrap">Quản lý sản phẩm</a>
              <form method="post" action="{{ route('logout') }}" class="block no-underline  px-4 py-2 text-gray-800 hover:bg-gray-100 whitespace-nowrap">
                  @csrf
                  
                  <button type="submit">Đăng xuất</button>
              </form>
          </div>
      </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userImage = document.getElementById('user-image');
    const optionsDropdown = document.getElementById('options-dropdown');

    // Show the dropdown when the image is hovered
    userImage.addEventListener('mouseover', function() {
      optionsDropdown.classList.remove('hidden');  // Show the dropdown
    });

    // Hide the dropdown when the mouse leaves the image
    userImage.addEventListener('mouseout', function() {
        if (userImage.contains(event.target) && !optionsDropdown.contains(event.target)) {
        optionsDropdown.classList.remove('hidden');  // Hide the dropdown if clicked outside
      }
      else {
    optionsDropdown.classList.add('hidden');  
    }// Hide the dropdown
    });

    // Optional: Close the dropdown when clicked anywhere outside the dropdown
    document.addEventListener('click', function(event) {
      if (!userImage.contains(event.target) && !optionsDropdown.contains(event.target)) {
        optionsDropdown.classList.add('hidden');  // Hide the dropdown if clicked outside
      }
    });
  });
</script>