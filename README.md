# Tên Dự Án
Dự Án Website Bán Đồ Điện Tử Laravel blade + REACT FRONTEND 
## Mục Lục
- [Tên Dự Án](#giới-thiệu)
- [Những Thứ cần thêm và sửa](#cài-đặt)
- [Các Chức Năng của Website](#sử-dụng)
- [Sử dụng](#hướng-dẫn-sử-dụng)
- [Kết luận](#liên-hệ)
## Những Thứ cần thêm và sửa
- Gửi Thông báo lại khách hàng
- Xử lý giảm giá
- Cài Đặt Ngôn ngữ
- cài đặt Thanh toán online vân vân
- tìm kiếm sản phẩm
## Các Chức Năng của Website
- Đăng Nhập, Đăng kí, validate 
- Quên Mật Khẩu, Gửi Xác Nhận Email qua SMPT (tạo mã click dẫn tới reset pwd/token nếu token không đúng thì k vào được trang)
- Dashboard: Hiện Danh Sách Thành Phần, Doanh thu,Đơn hàng mới, Cài Đặt
- Quản lý sản phẩm CRUD , tìm kiếm , Danh sách
- Quản Banner  CRUD  , Danh sách
- Quản lý Giảm Giá CRUD , tìm kiếm , Danh sách
- Quản lý Đơn Hàng   Danh sách, Cập Nhật Trạng thái sử dụng ajax
- Quản lý Khách Hàng  , thông tin khách hàng, Danh sách , danh sách đánh giá
## Cài đặt
``` bash
git clone https://github.com/
cd repository
- Cài Đặt PHP và Composer và XAPP hoặc Môi trường server  Ảo 
- Cài Đặt Các Phụ Thuộc của Dự Án: composer install
- Cấu Hình Database tại .env
- tạo database và migrate để tạo các bảng cho việc lưu trữ 
- php artisan db:seed RolePermissionSeeder tạo dữ liệu cơ bản cho bảng roles and permissions
npm install
composer run dev
## Lưu ý 
- tư duy migrate các bảng theo dạng foreign key phải tạo bảng cha trước
- làm từng bước một
```
## Sử dụng
- đọc tài liệu tại website https://laravel.com/docs/11.x

### Kết luận
Dự Án Học Cách Tạo Website Bán hàng Điện tử với laravel 11 