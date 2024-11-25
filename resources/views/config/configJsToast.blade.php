<script>
  // Configure Toastr options
  toastr.options = {
        "closeButton": true,  // Hiển thị nút đóng
        "debug": false,
        "newestOnTop": true,  // Hiển thị thông báo mới nhất ở trên cùng
        "progressBar": true,  // Hiển thị thanh tiến trình
        "positionClass": "toast-top-center",  // Vị trí ở giữa màn hình và trên cùng
        "preventDuplicates": true,  // Ngăn việc hiển thị các thông báo giống nhau liên tiếp
        "showDuration": "300",  // Thời gian hiển thị
        "hideDuration": "1000",  // Thời gian ẩn đi
        "timeOut": "5000",  // Thời gian hiển thị thông báo (ms)
        "extendedTimeOut": "1000",  // Thời gian kéo dài sau khi hover chuột
        "showEasing": "swing",  // Hiệu ứng khi hiển thị
        "hideEasing": "linear",  // Hiệu ứng khi ẩn
        "showMethod": "fadeIn",  // Hiệu ứng xuất hiện
        "hideMethod": "fadeOut"  // Hiệu ứng ẩn
    }
</script>
  <!-- // Display success message if exists -->
  @if(session('cuccess'))
  <script>
  toastr.success("{{ session('cuccess') }}",'Thành Công');
  </script>
  @endif
  <!-- // Display error message if exists -->
  @if(session('error'))
  <script>
  toastr.error("{{ session('error') }}",'Lỗi');

  </script>
  @endif
  <!-- // Display warning message if exists -->
  @if(session('warning'))
  <script>
    toastr.warning("{{ session('warning') }}",'Cảnh Báo');
  </script>
  @endif
  <!-- // Display info message if exists -->
  @if(session('infor'))
  <script>
    toastr.info("{{ session('infor') }}",'Thông Tin');
  </script>

  @endif

