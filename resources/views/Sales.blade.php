@extends('layout.app')
@section('title', 'Cấu Hình Bán Hàng')
@section('content')
<div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Cấu hình tiền tệ</h2>

    <!-- Loại tiền tệ -->
    <label for="currency" class="block text-sm font-medium text-gray-600 mb-2">Chọn loại tiền tệ</label>
    <select id="currency" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
      <option value="VND">VNĐ</option>
      <option value="USD">USD</option>
    </select>

    <!-- Tỷ giá hối đoái -->
    <div id="exchange-rate-container" class="mt-4 hidden">
      <label for="exchange-rate" class="block text-sm font-medium text-gray-600 mb-2">Tỷ giá hối đoái (so với VNĐ)</label>
      <input
        type="number"
        id="exchange-rate"
        placeholder="Nhập tỷ giá hối đoái"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      />
    </div>

    <!-- Nút lưu -->
    <button
      id="save-btn"
      class="mt-6 w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200"
    >
      Lưu cài đặt
    </button>
  </div>

  <script>
    // Xử lý sự kiện khi chọn loại tiền tệ
    const currencySelect = document.getElementById('currency');
    const exchangeRateContainer = document.getElementById('exchange-rate-container');
    const exchangeRateInput = document.getElementById('exchange-rate');

    currencySelect.addEventListener('change', () => {
      const selectedCurrency = currencySelect.value;
      if (selectedCurrency === 'USD') {
        exchangeRateContainer.classList.remove('hidden'); // Hiện tỷ giá hối đoái
      } else {
        exchangeRateContainer.classList.add('hidden'); // Ẩn tỷ giá hối đoái
        exchangeRateInput.value = ''; // Xóa giá trị tỷ giá
      }
    });

    // Xử lý nút lưu
    const saveBtn = document.getElementById('save-btn');
    saveBtn.addEventListener('click', () => {
      const selectedCurrency = currencySelect.value;
      const exchangeRate = exchangeRateInput.value;

      if (selectedCurrency === 'USD' && !exchangeRate) {
        alert('Vui lòng nhập tỷ giá hối đoái cho USD.');
        return;
      }

      const config = {
        currency: selectedCurrency,
        exchangeRate: selectedCurrency === 'USD' ? exchangeRate : null,
      };

      console.log('Cài đặt được lưu:', config);
      alert('Cài đặt đã được lưu thành công!');
    });
  </script>
@endsection