<script>
    document.addEventListener('DOMContentLoaded', function() {
        var contentDiv = document.getElementById('description');
        if (contentDiv) {
            var cleanedContent = contentDiv.textContent.replace(/"/g, ''); // Loại bỏ tất cả dấu ngoặc kép
            contentDiv.textContent = cleanedContent; // Cập nhật nội dung
        }
    });
</script>