
var product_sales = document.querySelectorAll(".product-item ");
for(let product of product_sales){
    product.addEventListener('mouseover',function(){
        const srcV2Attribute = this.querySelector('img').dataset.srcV2;
        this.querySelector('img').setAttribute('src',srcV2Attribute);
    });
    product.addEventListener('mouseout',function(){
        const srcV1Attribute = this.querySelector('img').dataset.srcV1;
        this.querySelector('img').setAttribute('src',srcV1Attribute);
    })

}
$(document).ready(function(){
    $('.navbar-toggle').click(function(){
        $('.wp-responsive').stop().slideToggle(500);
        $(this).toggleClass('bg-red');
            hide_responsive_submenu()
    })
   $('.responsive-menu-toggle').click(function(){
        $(this).next('ul.sub-menu').slideToggle(500)
        $(this).toggleClass('open')
   })
    function hide_responsive_menu(){
        $('.navbar-toggle').removeClass('bg-red');
        $('.wp-responsive').slideUp(500);
    }
    function hide_responsive_submenu(){
        $('ul#menu-responsive ul.sub-menu').slideUp(500);
        $('.responsive-menu-toggle').removeClass('open')
    }
        $(window).resize(function(){
            hide_responsive_menu()
            hide_responsive_submenu()
        })
        $(window).scroll(function(){
            hide_responsive_menu()
            hide_responsive_submenu()
        });

        //form
        $('.search-responsive').click(function(){
           if($(this).prev('input.search-form-responsive').hasClass('display-none')){
            $(this).prev('input.search-form-responsive').removeClass('display-none')
            $(this).prev('input.search-form-responsive').addClass('display-block')
            $($(this)).addClass('bg-gray')
           }else if($(this).prev('input.search-form-responsive').hasClass('display-block')){
            $(this).prev('input.search-form-responsive').removeClass('display-block')
            $(this).prev('input.search-form-responsive').addClass('display-none')
            $($(this)).removeClass('bg-gray')
           }
        })
        // $('.search-responsive').click(function(){
        //     $(this).prev('input.search-form-responsive').toggleClass('display-block')
        //  })
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        })
});
// slider detail product
$(document).ready(function () {
    $('.list-thumb .thumb-item').click(function () {
        let picture_src = $(this).find('img').attr('src');
        $('.show-picture img').attr('src', picture_src);
        $('.list-thumb .thumb-item').removeClass('active');
        $(this).addClass('active');
    });
    //xử lý khi nhấp vào next and prev
    $('.slider-nav .next-btn').click(function () {
        if ($('.list-thumb .thumb-item:last-child').hasClass('active')) {
            $('.list-thumb .thumb-item:first-child').click();
        } else {
            $('.list-thumb .thumb-item.active').next().click();
        }

    });
    $('.slider-nav .prev-btn').click(function () {
        if ($('.list-thumb .thumb-item:first-child').hasClass('active')) {
            $('.list-thumb .thumb-item:last-child').click();
        } else {
            $('.list-thumb .thumb-item.active').prev().click();
        }

    });
});

// modal auto 
const countdown = () => {
    // Xác định thời điểm đích mà bạn muốn đếm ngược. Ở đây, thời điểm đích là 23:59:59 ngày 31/12/2024.
      const endTime = new Date("2024-12-31T23:59:59").getTime();
      const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;
  
        if (distance < 0) {
          clearInterval(timer);
          document.querySelector(".countdown").innerHTML = "Hết hạn khuyến mãi!";
          return;
        }
        /*
        TÍNH SỐ NGÀY
        1000 * 60 * 60 * 24: Số mili giây trong một ngày.

        1000 mili giây = 1 giây.
        1000 * 60 = 1 phút.
        1000 * 60 * 60 = 1 giờ.
        1000 * 60 * 60 * 24 = 1 ngày.
        distance / (1000 * 60 * 60 * 24): Tính số ngày còn lại bằng cách chia tổng thời gian còn lại (distance) cho số mili giây trong một ngày.
        Math.floor: Lấy phần nguyên (bỏ đi phần thập phân).
        Ví dụ:
        distance = 90061000 (tổng thời gian còn lại).
        Số mili giây trong 1 ngày: 86400000.
        90061000 / 86400000 = 1.042 (khoảng 1 ngày).
        Math.floor(1.042) = 1 (chỉ tính phần nguyên là 1 ngày).
        
        TÍNH SỐ GIỜ CÒN LẠI
        distance % (1000 * 60 * 60 * 24):

        Lấy phần dư của distance khi chia cho số mili giây trong một ngày.
        Phần dư này là phần còn lại sau khi trừ đi số ngày.
        / (1000 * 60 * 60):
        Chia số mili giây còn lại cho số mili giây trong một giờ để tính số giờ.
        Math.floor: Lấy phần nguyên (bỏ đi phần thập phân).
        Ví dụ:
        distance = 90061000.
        distance % 86400000 = 3661000 (phần còn lại sau khi tính 1 ngày).
        Số mili giây trong 1 giờ: 3600000.
        3661000 / 3600000 = 1.0169 (khoảng 1 giờ).
        Math.floor(1.0169) = 1 (lấy phần nguyên là 1 giờ).

        TÍNH SỐ PHÚT CÒN LẠI
        distance % (1000 * 60 * 60):
        Lấy phần dư của distance khi chia cho số mili giây trong một giờ.
        Phần dư này là phần còn lại sau khi trừ đi số giờ.
        / (1000 * 60):
        Chia số mili giây còn lại cho số mili giây trong một phút để tính số phút.
        Math.floor: Lấy phần nguyên.
        Ví dụ:
        distance = 90061000.
        distance % 3600000 = 61000 (phần còn lại sau khi tính 1 giờ).
        Số mili giây trong 1 phút: 60000.
        61000 / 60000 = 1.016 (khoảng 1 phút).
        Math.floor(1.016) = 1 (lấy phần nguyên là 1 phút).

        TÍNH SỐ GIÂY
        distance % (1000 * 60):
        Lấy phần dư của distance khi chia cho số mili giây trong một phút.
        Phần dư này là phần còn lại sau khi trừ đi số phút.
        / 1000:
        Chia số mili giây còn lại cho 1000 để tính số giây.
        Math.floor: Lấy phần nguyên.
        Ví dụ:
        distance = 90061000.
        distance % 60000 = 1000 (phần còn lại sau khi tính 1 phút).
        1000 / 1000 = 1 (tương ứng 1 giây).
        */
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
        document.querySelector(".countdown").innerHTML = `
          <span><strong>${days}</strong> NGÀY</span>
          <span><strong>${hours}</strong> GIỜ</span>
          <span><strong>${minutes}</strong> PHÚT</span>
          <span><strong>${seconds}</strong> GIÂY</span>
        `;
      }, 1000);
    };

    // Đóng modal
    function closeModal() {
    document.getElementById('promotionModal').style.display = 'none';
    sessionStorage.setItem('modalShown', 'true'); // Lưu trạng thái modal đã được hiển thị
}

// Chuyển hướng đến trang mua hàng
    function shopNow() {
    window.location.href = '/link-mua-hang'; // Thay bằng link mua hàng của bạn
        }

// Gọi hàm đếm ngược khi tải trang
    window.onload = function () {
    // Kiểm tra trạng thái modal trong sessionStorage
    const modalShown = sessionStorage.getItem('modalShown');

    if (!modalShown) {
    // Nếu modal chưa được hiển thị, hiển thị modal và bắt đầu đếm ngược
    document.getElementById('promotionModal').style.display = 'block';
    countdown();
  }
};

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.nextElementSibling;
            const value = parseInt(input.value, 10);
            if (value > 1) {
                input.value = value - 1;
            }
        });
    });

    document.querySelectorAll('.btn-increase').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const value = parseInt(input.value, 10);
            input.value = value + 1;
        });
    });
});

 // CHOOSE NUMBER ORDER
   // Khi nhấn nút tăng (plus)
   $('#plus').click(function() {
    var numOrder = $('#num-order');
    var currentValue = parseInt(numOrder.val(), 10); // Chuyển giá trị thành số
    if (isNaN(currentValue)) { // Nếu không phải là số hợp lệ
        currentValue = 1; // Thiết lập giá trị mặc định là 1
    }
    numOrder.val(currentValue + 1); // Tăng giá trị lên 1
});

// Khi nhấn nút giảm (minus)
$('#minus').click(function() {
    var numOrder = $('#num-order');
    var currentValue = parseInt(numOrder.val(), 10); // Chuyển giá trị thành số
    if (isNaN(currentValue)) { // Nếu không phải là số hợp lệ
        currentValue = 1; // Thiết lập giá trị mặc định là 1
    }
    // Kiểm tra nếu giá trị lớn hơn 1
    if (currentValue > 1) {
        numOrder.val(currentValue - 1); // Giảm giá trị đi 1
    }
});

// Kiểm tra khi người dùng rời khỏi trường nhập liệu (blur)
$('#num-order').blur(function() {
    var numOrder = $('#num-order');
    var currentValue = parseInt(numOrder.val(), 10); // Chuyển giá trị thành số
    if (isNaN(currentValue) || currentValue <= 0) { // Nếu không phải số hợp lệ hoặc <= 0
        numOrder.val(1); // Đặt giá trị lại là 1
    }
});

