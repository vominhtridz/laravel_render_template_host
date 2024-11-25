@extends('layout.app')
@section('title', 'Cấu Hình Thuế và Phí Vận Chuyển')
@section('content')
<div class="container mx-auto px-4 ">
    <!-- Quản lý Thuế-->
<div class="flex justify-between items-center my-6">
            <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Thuế</h2>
            <a href="{{ route('Add_Tax') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i> Thêm Thuế
            </a>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-2 whitespace-nowrap border-b">Tên Thuế</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Tỷ Lệ Thuế (%)</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Mô Tả</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Loại Thuế</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Ngày Bắt Đầu</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Ngày Kết Thúc</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Tiền Tệ</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Vùng Áp Dụng</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Miễn Giảm</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">VAT</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Đối Tượng Áp Dụng</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Trạng Thái</th>
            <th class="py-2 px-2 whitespace-nowrap border-b">Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @if($taxes && $taxes->count() > 0)
            @foreach($taxes as $tax)
                <tr>
                    <td class="py-2 px-2 text-left border-b">{{ $tax->name }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ number_format($tax->tax_rate, 2) }}%</td>
                    <td class="py-2 px-2 text-left leading-4 border-b">
                     @php 
                        echo str_replace('"', '', $tax->description);  // Cách gọi đúng
                        @endphp 
                        </td>
                    <td class="py-2 px-2 text-left border-b">{{ $tax->tax_type }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $tax->start_date }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $tax->end_date ?? 'Không giới hạn' }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $tax->currency }}</td>
                    <td class="py-2 px-2 text-left border-b">{{ $tax->region }}</td>
                    <td class="py-2 px-2 text-left border-b">{{ $tax->exemption_criteria ?? 'Không áp dụng' }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ $tax->is_vat ? 'Có' : 'Không' }}</td>
                    <td class="py-2 px-2 text-left border-b">{{ $tax->applicable_to }}</td>
                    <td class="py-2 px-2 text-center border-b">
                        <span class="{{ $tax->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $tax->status ? 'Hoạt động' : 'Không hoạt động' }}
                        </span>
                    </td>
                    <td class="py-2 px-2 text-center border-b">
                        <div class="flex items-center justify-center">
                            <!-- Chỉnh sửa -->
                            <a href="{{ route('Edit_Tax', $tax->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <!-- Xóa -->
                            <form method="POST" action="{{ route('handleRemoveTax', $tax->id) }}" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13" class="py-6 px-2 text-center text-gray-700">Không có dữ liệu thuế</td>
            </tr>
        @endif
    </tbody>
</table>

    <div class="flex justify-between items-center my-6">
            <h2 class="text-3xl font-semibold">Danh Sách Tất Cả Phí Vận Chuyển</h2>
            <a href="{{ route('Add_Shipfee') }}" class="bg-blue-600 text-white px-2 text-sm whitespace-nowrap py-2 rounded-md hover:bg-blue-700">
                <i class="fas fa-plus-circle"></i> Thêm Phí Vận Chuyển
            </a>
        </div>
       <table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">ID</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Phí Vận Chuyển</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Kiểu Phí</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Miễn Phí Vận Chuyển</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Giảm Giá</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Trạng Thái</th>
            <th class="py-2 px-2 text-center whitespace-nowrap border-b">Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @if($shipfees && $shipfees->count() > 0)
            @foreach($shipfees as $item)
                <tr>
                    <td class="py-2 px-2 text-left border-b">{{ $item->id }}</td>
                    <td class="py-2 px-2 text-center border-b">{{ number_format($item->shipping_fee, 0, ',', '.') }} VNĐ</td>
                    <td class="py-2 px-2 text-left border-b">theo {{ $item->shipfee_type }}</td>
                    <td class="py-2 px-2 text-center border-b">
                        {{ $item->is_free_shipping ? 'Có' : 'Không' }}
                    </td>
                    <td class="py-2 px-2 text-center border-b">{{ number_format($item->discount_amount, 0, ',', '.') }} VNĐ</td>
                    <td class="py-2 px-2 text-center border-b">
                        <span class="{{ $item->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $item->status ? 'Hoạt động' : 'Không hoạt động' }}
                        </span>
                    </td>
    
                    <td class="py-2 px-2 text-center text-sm whitespace-nowrap border-b">
                        <div class="flex items-center">
                            <a href="{{ route('Edit_Shipfee', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form method="POST" action="{{ route('handleRemoveshipfee', $item->id) }}" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9" class="py-6 px-2 text-center text-gray-700">Chưa có Phí Vận Chuyển Nào </td>
            </tr>
        @endif
    </tbody>
</table>

  </div>
@endsection