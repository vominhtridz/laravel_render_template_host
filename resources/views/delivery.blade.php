@extends('layout.app')
@section('title', 'Cài Đặt Giao Hàng')
@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-md p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-700">Cài đặt Giao hàng</h1>

    <!-- Phương thức giao hàng -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Phương thức giao hàng</h2>
      <div class="space-y-4">
        <div>
          <input type="checkbox" id="localDelivery" class="mr-2">
          <label for="localDelivery" class="text-gray-700">Giao hàng nội địa</label>
        </div>
        <div>
          <input type="checkbox" id="internationalDelivery" class="mr-2">
          <label for="internationalDelivery" class="text-gray-700">Giao hàng quốc tế</label>
        </div>
        <div>
          <input type="checkbox" id="storePickup" class="mr-2">
          <label for="storePickup" class="text-gray-700">Nhận hàng tại cửa hàng</label>
        </div>
      </div>
    </div>

    <!-- Tích hợp nhà vận chuyển -->
    <div class="mb-8">
      <h2 class="text-xl font-medium text-gray-600 mb-4">Tích hợp nhà vận chuyển</h2>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Chọn nhà vận chuyển</label>
          <select id="carrierAPI" class="w-full p-2 border border-gray-300 rounded-md">
            <option value="GHN">GHN</option>
            <option value="ViettelPost">ViettelPost</option>
            <option value="GHTK">GHTK</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Cấu hình giá ship tự động</label>
          <input type="checkbox" id="autoShippingCost" class="mr-2">
          <label for="autoShippingCost" class="text-gray-700">Bật</label>
        </div>
      </div>
    </div>

    <!-- Khu vực giao hàng -->
    <div>
      <h2 class="text-xl font-medium text-gray-600 mb-4">Khu vực giao hàng</h2>
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">Thêm khu vực</label>
        <form id="addZoneForm" class="grid grid-cols-3 gap-4">
          <input type="text" id="zoneName" placeholder="Tên khu vực" class="p-2 border border-gray-300 rounded-md">
          <input type="number" id="zoneFee" placeholder="Phí giao hàng" class="p-2 border border-gray-300 rounded-md">
          <button type="button" id="addZoneBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Thêm</button>
        </form>
      </div>
      <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-600 mb-2">Danh sách khu vực</h3>
        <table class="w-full border border-gray-300 rounded-md">
          <thead class="bg-gray-100 text-gray-600">
            <tr>
              <th class="p-2 text-left">Tên khu vực</th>
              <th class="p-2 text-left">Phí giao hàng</th>
              <th class="p-2 text-center">Hành động</th>
            </tr>
          </thead>
          <tbody id="zoneList" class="text-gray-700">
            <!-- Dữ liệu sẽ được thêm bằng JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const zoneList = [];

    // Thêm khu vực giao hàng
    document.getElementById('addZoneBtn').addEventListener('click', () => {
      const zoneName = document.getElementById('zoneName').value.trim();
      const zoneFee = document.getElementById('zoneFee').value.trim();

      if (!zoneName || !zoneFee) {
        alert('Vui lòng nhập đầy đủ thông tin!');
        return;
      }

      const zone = { name: zoneName, fee: parseFloat(zoneFee).toFixed(2) };
      zoneList.push(zone);
      renderZoneList();
      clearZoneForm();
    });

    // Xóa khu vực
    function deleteZone(index) {
      zoneList.splice(index, 1);
      renderZoneList();
    }

    // Hiển thị danh sách khu vực
    function renderZoneList() {
      const tbody = document.getElementById('zoneList');
      tbody.innerHTML = '';
      zoneList.forEach((zone, index) => {
        tbody.innerHTML += `
          <tr class="border-t border-gray-300">
            <td class="p-2">${zone.name}</td>
            <td class="p-2">${zone.fee}₫</td>
            <td class="p-2 text-center">
              <button class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 transition" onclick="deleteZone(${index})">Xóa</button>
            </td>
          </tr>
        `;
      });
    }

    // Xóa dữ liệu trong form sau khi thêm
    function clearZoneForm() {
      document.getElementById('zoneName').value = '';
      document.getElementById('zoneFee').value = '';
    }
  </script>
@endsection