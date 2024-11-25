@extends('layout.app')
@section('title', 'Danh Sách Đơn Hàng')

@section('content')
<div class="container mx-auto px-4 ">
    <!-- Quản lý Đơn Hàng -->
        <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Đơn Hàng</h2>


    <table class="min-w-full bg-white border border-gray-200 mr-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Khách Hàng</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Ngày Hoàn Thành</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thanh Toán</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Địa Chỉ Giao Hàng</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Vận Chuyển</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Ghi Chú</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Tổng Tiền</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Trạng Thái Thanh Toán</th>
                <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @if($orders && $orders->count() > 0)
                @foreach($orders as $order)
                    <tr>

                        <td class="py-2 px-2 text-center border-b text-sm">
                            <a href="/customers/infor/{{$order->customers->customer_id}}" class="hover:!text-blue-500 hover:!underline">{{ $order->customers->name }}</a>
                        </td>
                        <td class="py-2 px-2 text-center border-b text-sm">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                        <td class="py-2 px-2 text-center border-b text-sm">{{ $order->payment_method == 'cod'? 'Sau Khi Nhận Hàng' :'Chuyển Khoản Ngân Hàng'}}</td>
                        
                        <td class="py-2 px-2 text-center border-b text-sm">
                           {{$order->order_items->first()->address->detail_address}}
                        </td>
                        <td class="py-2 px-2 text-center border-b text-sm">{{ $order->shipping_method }}</td>
                        <td class="py-2 px-2 text-center border-b text-sm whitespace-nowrap">{{$order->notes ?? 'không có' }}</td>
                        <td class="py-2 px-2 text-center border-b text-sm text-red-500 font-medium whitespace-nowrap">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                        <td class="py-2 px-2 text-center border-b text-sm">
                        <span id="status-span-{{$order->order_id}}" class="px-2 py-2 whitespacenowrap rounded bg-green-600 text-white">
                            {{$order->order_status}}
                        </span>
                        </td>
                        <td class="py-2 px-2 text-center border-b text-sm">
                            <div class="flex items-center justify-center">
                                <!-- Chỉnh sửa -->

            <div class="px-4">
    <select 
        onchange="ChangeStatus({{ $order->order_id }})" 
        id="orderStatus-{{ $order->order_id }}" 
        class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option {{ $order->order_status == 'processing' ? 'selected' : '' }} value="processing">Đang xử lý</option>
        <option {{ $order->order_status == 'confirm_bank' ? 'selected' : '' }} value="confirm_bank">Xác Nhận Ngân Hàng</option>
        <option {{ $order->order_status == 'delivering' ? 'selected' : '' }} value="delivering">Đang Vận Chuyển</option>
        <option {{ $order->order_status == 'completed' ? 'selected' : '' }} value="completed">Hoàn thành</option>
        <option {{ $order->order_status == 'cancelled' ? 'selected' : '' }} value="cancelled">Đã hủy</option>
    </select>
</div>

                                <!-- Xóa -->
                                <form method="POST" action="{{ route('admin.orders.remove', ['id' => $order->order_id]) }}" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="whitespace-nowrap text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu Đơn Hàng</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function ChangeStatus(orderId) {
        // Lấy giá trị trạng thái từ select tương ứng với orderId
        const status = document.getElementById('orderStatus-' + orderId).value;
        
        // Gọi AJAX để cập nhật trạng thái đơn hàng
        $.ajax({
            url: `/orders/updatestatus/${orderId}`,  // Đường dẫn API
            type: 'POST',
            data: JSON.stringify({ status }),  // Dữ liệu gửi lên (trạng thái mới)
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),  // CSRF Token
            },
            success: function (response) {
                    toastr.success(response?.message,'Thành Công');
                 const statusSpan = document.querySelector(`#status-span-${orderId}`); // Giả sử bạn có một thẻ <span> với id tương ứng
                statusSpan.textContent = status;  // Cập nhật trạng thái
                // Cập nhật lại giá trị trong select (nếu cần)
                const selectElement = document.getElementById('orderStatus-' + orderId);
                selectElement.value = status;
            },
            error: function (xhr) {
                console.log('Có lỗi xảy ra: ' + xhr.responseText);
            },
        });
    }
</script>

@endsection
