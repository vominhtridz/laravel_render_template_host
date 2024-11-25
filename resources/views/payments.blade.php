@extends('layout.app')
@section('title', 'Cài Đặt Thanh Toán')
@section('content')
 <div class="max-w-5xl mx-auto bg-white shadow-md rounded-md p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-700">Cài đặt Thanh toán</h1>

    <!-- Phương thức thanh toán -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Phương thức thanh toán</h2>
      <div class="space-y-4">
        <div>
          <input type="checkbox" id="cod" class="mr-2">
          <label for="cod" class="text-gray-700">Thanh toán COD (khi nhận hàng)</label>
        </div>
        <div>
          <input type="checkbox" id="onlinePayment" class="mr-2">
          <label for="onlinePayment" class="text-gray-700">Thanh toán online (MoMo, ZaloPay, VNPay)</label>
        </div>
        <div>
          <input type="checkbox" id="cardPayment" class="mr-2">
          <label for="cardPayment" class="text-gray-700">Thanh toán qua thẻ (Visa/Mastercard)</label>
        </div>
      </div>
    </div>

    <!-- Tích hợp cổng thanh toán -->
    <div>
      <h2 class="text-xl font-medium text-gray-600 mb-4">Tích hợp cổng thanh toán</h2>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600 mb-2">Thêm cổng thanh toán</label>
        <form id="addGatewayForm" class="grid grid-cols-3 gap-4">
          <input type="text" id="gatewayName" placeholder="Tên cổng thanh toán" class="p-2 border border-gray-300 rounded-md">
          <input type="number" step="0.01" id="transactionFee" placeholder="Phí giao dịch (%)" class="p-2 border border-gray-300 rounded-md">
          <button type="button" id="addGatewayBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Thêm</button>
        </form>
      </div>
      <div>
        <h3 class="text-lg font-medium text-gray-600 mb-2">Danh sách cổng thanh toán</h3>
        <table class="w-full border border-gray-300 rounded-md">
          <thead class="bg-gray-100 text-gray-600">
            <tr>
              <th class="p-2 text-left">Tên cổng thanh toán</th>
              <th class="p-2 text-left">Phí giao dịch (%)</th>
              <th class="p-2 text-center">Hành động</th>
            </tr>
          </thead>
          <tbody id="gatewayList" class="text-gray-700">
            <!-- Dữ liệu sẽ được thêm bằng JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const gatewayList = [];

    // Thêm cổng thanh toán
    document.getElementById('addGatewayBtn').addEventListener('click', () => {
      const name = document.getElementById('gatewayName').value.trim();
      const fee = document.getElementById('transactionFee').value.trim();

      if (!name || !fee) {
        alert('Vui lòng nhập đầy đủ thông tin!');
        return;
      }

      const gateway = { name, fee: parseFloat(fee).toFixed(2) };
      gatewayList.push(gateway);
      renderGatewayList();
      clearGatewayForm();
    });

    // Xóa cổng thanh toán
    function deleteGateway(index) {
      gatewayList.splice(index, 1);
      renderGatewayList();
    }

    // Hiển thị danh sách cổng thanh toán
    function renderGatewayList() {
      const tbody = document.getElementById('gatewayList');
      tbody.innerHTML = '';
      gatewayList.forEach((gateway, index) => {
        tbody.innerHTML += `
          <tr class="border-t border-gray-300">
            <td class="p-2">${gateway.name}</td>
            <td class="p-2">${gateway.fee}%</td>
            <td class="p-2 text-center">
              <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition" onclick="deleteGateway(${index})">Xóa</button>
            </td>
          </tr>
        `;
      });
    }

    // Xóa dữ liệu trong form sau khi thêm
    function clearGatewayForm() {
      document.getElementById('gatewayName').value = '';
      document.getElementById('transactionFee').value = '';
    }
  </script>
@endsection