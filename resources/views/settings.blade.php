@extends('layout.app')
@section('title', 'Cài Đặt Chung')
@section('content')
  <div class="container mx-auto px-4 pb-6">
        <h1 class="text-3xl font-bold mb-6">Cài Đặt Chung</h1>
    <!-- Hiển thị lỗi nếu có -->
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" class="  w-full" action="{{ route('handleSetting_General') }}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @method('post')

    <!-- Hiển thị lỗi chung nếu có -->
    <div class="mb-4">
        <label for="web_name" class="block outline-none text-base font-medium text-gray-700">Tên Website</label>
        <input 
            name="web_name" 
            value="{{  !is_null($settings) ? $settings->web_name:''  }}"  
            required 
            placeholder="Nhập tên website..." 
            type="text" 
            id="web_name" 
            class="mt-1 px-2 py-1.5 block outline-none border w-full border-gray-500 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" 
        >
        @error('web_name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
     <div class="mb-4">
        <label for="address" class="block outline-none text-base font-medium text-gray-700">Địa Chỉ Website</label>
        <input 
            name="address" 
            value="{{  !is_null($settings) ? $settings->address:''  }}"  
            required 
            placeholder="Nhập Địa Chỉ website..." 
            type="text" 
            id="address" 
            class="mt-1 px-2 py-1.5 block outline-none border w-full border-gray-500 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" 
        >
        @error('address')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <!-- Information bank -->

     <div class="mb-4">
        <label for="infor_bank" class="block outline-none text-base font-medium text-gray-700">Ngân hàng Website</label>
        <input 
            name="infor_bank" 
            value="{{  !is_null($settings) ? $settings->infor_bank:''  }}"  
            required 
            placeholder="Nhập thông tin chi tiết ngân hàng.." 
            type="text" 
            id="infor_bank" 
            class="mt-1 px-2 py-1.5 block outline-none border w-full border-gray-500 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" 
        >
        @error('infor_bank')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <!-- email -->
<div class="mb-4">
        <label for="email" class="block outline-none text-base font-medium text-gray-700">Email Chính Website</label>
        <input 
            name="email" 
            value="{{  isset($settings) && !is_null($settings) ? $settings->email:''  }}"
            required 
            placeholder="Nhập Email..." 
            type="email" 
            id="email" 
            class="mt-1 px-2 py-1.5 block outline-none w-full border border-gray-500 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" 
        >
        @error('email')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    
   

    <div class="mb-4">
        <label for="productImage" class="block outline-none text-base font-medium text-gray-700">Logo Website</label>
        <img id="renderImg" src="{{ !is_null($settings) ? $settings->logo : '/images/addimage.jpg' }}" alt="Category Image" class="w-44 h-46 object-cover mb-4" />
        <input 
            name="logo" 
            type="file" 
            id="productImage" 
            class="mt-1 px-2 py-1 block outline-none w-full border border-gray-500 rounded-md shadow-sm"
        >
        @error('image')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
             Cập Nhật 
        </button>
      
    </div>
    </form>
  </div>
<script>
  const image = document.getElementById('productImage');
  const renderImg = document.querySelector('#renderImg');
  // Display image preview if there's an existing image when the page loads
  if (renderImg && renderImg.src) {
      renderImg.style.display = 'block';
  }
  // Update the image preview when a new image is selected
  image.addEventListener('change', function (event) {
      const file = this.files[0];

      if (file) {
          const url = URL.createObjectURL(file);
          renderImg.src = url; // Set the new preview image
          renderImg.style.display = 'block'; // Ensure the image preview is visible
      }
  });
</script>
@endsection
