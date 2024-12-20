

// Đảm bảo mã JavaScript chỉ chạy sau khi DOM đã được tải
document.addEventListener('DOMContentLoaded', function() {
    // Lấy các phần tử trong form
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm-password');
    const errorMessage = document.getElementById('error-message');
    const form = document.querySelector('form');
    
    // Thêm sự kiện submit cho form
    form.addEventListener('submit', function(event) {
        // Kiểm tra xem mật khẩu và xác nhận mật khẩu có khớp không
        if (passwordField.value !== confirmPasswordField.value) {
            // Ngừng gửi form
            event.preventDefault();
            
            // Hiển thị thông báo lỗi
            errorMessage.textContent = "Mật khẩu không trùng khớp!";
            errorMessage.style.color = "red";
        } else {
            // Nếu mật khẩu khớp, xóa thông báo lỗi (nếu có)
            errorMessage.textContent = "";
            alert('Đăng kí thành công');
        }
    });
});

