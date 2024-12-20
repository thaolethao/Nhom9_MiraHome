

document.querySelector('.signup-form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const errorMessage = document.getElementById('error-message');

    if (password !== confirmPassword) {
        event.preventDefault(); // Ngăn gửi form
        errorMessage.textContent = 'Confirm password does not match with create password.';
    } else {
        errorMessage.textContent = ''; // Xóa thông báo lỗi nếu khớp
    }
});

var a=1;
var b=2;
alert('xin chao!!!');
