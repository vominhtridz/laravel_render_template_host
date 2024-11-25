  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <aside class="w-64 fixed top-[3.8rem] left-0 bottom-0 bg-gray-800 text-white flex flex-col">
     
        <nav class="flex-1 overflow-y-auto ">
            <!-- Dashboard -->
            <a href="/" 
               class="block px-4 py-2 text-white hover:bg-gray-700" 
               :class="{'active-link': isActive('/dashboard')}">
                Bảng điều khiển
            </a>

            <!-- Products -->
            <div x-data="{ open: isActive('/products') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center   hover:bg-gray-700" 
                        :class="{'active-link': isActive('/products')}">
                    <span>Quản lý sản phẩm</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    <a href="/products/add" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/products/add')}">
                        Thêm sản phẩm
                    </a>
                    <a href="/products" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/products/list')}">
                        Danh sách sản phẩm
                    </a>
                <a href="{{route('SearchProduct')}}" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/products/list')}">
                        Tìm kiếm sản phẩm
                    </a>
                </div>
            </div>
            <div x-data="{ open: isActive('/settings') }">
                            <button @click="open = !open" 
                                    class="flex justify-between w-full px-4 py-2.5 items-center   hover:bg-gray-700" 
                                    :class="{'active-link': isActive('/products')}">
                                <span>Cài Đặt</span>
                                <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" class="pl-6" x-transition>
                                <a href="/settings" 
                                class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                                :class="{'active-link': isActive('/settings')}">
                                    Cài Đặt Chung
                                </a>
                                <a href="/settings/email" 
                                class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                                :class="{'active-link': isActive('/products/list')}">
                                    Cài Đặt Email
                                </a>
                            <a href="/settings/payment" 
                                class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                                :class="{'active-link': isActive('/products/list')}">
                                    Cài Đặt Thanh Toán
                                </a>
                                  <a href="/settings/languages" 
                                class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                                :class="{'active-link': isActive('/products/list')}">
                                    Cài Đặt Ngôn Ngữ
                                </a>
                                  <a href="/settings/tax" 
                                class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                                :class="{'active-link': isActive('/settings/tax')}">
                                    Cài Đặt Thuế và phí vận chuyển
                                </a>
                                 
                            </div>
                        </div>
                        <!-- User -->
                        <div x-data="{ open: isActive('/users') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/users')}">
                    <span>Quản lý Người Dùng</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    <a href="/users/add" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/users/add')}">
                        Thêm Người Dùng
                    </a>
                    <a href="/users" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/users/list')}">
                        Danh sách Người Dùng
                    </a>
                </div>
            </div>
             <!-- Banner -->
                        <div x-data="{ open: isActive('/banners') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/banners')}">
                    <span>Quản lý Banner</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    <a href="/banners/add" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/banners/add')}">
                        Thêm Banner
                    </a>
                    <a href="/banners" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/banners/list')}">
                        Danh sách Banner
                    </a>
                </div>
            </div>
            <!-- categories -->
                 <div x-data="{ open: isActive('/categories') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/categories')}">
                    <span>Quản lý Danh Mục</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    <a href="/categories/add" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/categories/add')}">
                        Thêm Danh Mục
                    </a>
                    <a href="/categories" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/categories/list')}">
                        Danh sách Danh Mục
                    </a>
                </div>
            </div>
    
            <!-- report/revenue -->
                 <div x-data="{ open: isActive('/report/revenue') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/report/revenue')}">
                    <span>Quản lý Doanh Thu</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                
                    <a href="/report/revenue" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/report/revenue')}">
                        Doanh Thu
                    </a>
                </div>
            </div>
             <!-- promotion -->
                 <div x-data="{ open: isActive('/promotion') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/promotion')}">
                    <span>Quản lý Giảm Giá</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                
                    <a href="{{route('Promotion')}}" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/promotion')}">
                        Danh Sách Giảm Giá
                    </a>
                    <a href="/promotion/add" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/promotion')}">
                        Thêm giảm giá
                    </a>
                  
                </div>
            </div>
            <!-- Orders -->
            <div x-data="{ open: isActive('/orders') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/orders')}">
                    <span>Quản lý đơn hàng</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    
                   
                    <a href="/orders" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/orders/list')}">
                        Danh sách đơn hàng
                    </a>
                </div>
            </div>

            <!-- Customers -->
            <div x-data="{ open: isActive('/customers') }">
                <button @click="open = !open" 
                        class="flex justify-between w-full px-4 py-2.5 items-center  hover:!text-white hover:bg-gray-700" 
                        :class="{'active-link': isActive('/customers')}">
                    <span>Quản lý khách hàng</span>
                    <svg :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 10.586l3.293-2.879a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" class="pl-6" x-transition>
                    <a href="/customers/getAll" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/customers/list')}">
                        Danh sách khách hàng
                    </a>
                    <a href="/reviews" 
                       class="block px-4 py-1 !text-gray-400 hover:!text-white hover:bg-gray-700" 
                       :class="{'active-link': isActive('/customers/reviews')}">
                        Danh Sách Đánh Giá
                    </a>
                </div>
            </div>

          
        </nav>
    </aside>

 

<script>
function isActive(path) {
    return window.location.pathname.startsWith(path);
}
</script>