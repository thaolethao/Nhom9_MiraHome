
# API Routes Documentation

1. Client Routes

- GET /dang-nhap - Hiển thị form đăng nhập.
- POST /xu-ly-dang-nhap - Xử lý đăng nhập.
- GET /dang-ky - Hiển thị form đăng ký.
- POST /xu-ly-dang-ky - Xử lý đăng ký.
- GET /dang-xuat - Đăng xuất (middleware: auth).
- Google OAuth:
  - GET /authorized/google - Chuyển hướng đến Google.
  - GET /authorized/google/callback - Xử lý callback từ Google.

Trang chủ và Thông tin Chung

- GET / - Trang chủ.
- GET /gioi-thieu - Trang giới thiệu.
- GET /lien-he - Trang liên hệ.

Sản phẩm

- GET /san-pham - Danh sách sản phẩm.
- GET /san-pham/{slug?} - Sản phẩm theo danh mục.
- GET /san-pham/{id}/chi-tiet - Chi tiết sản phẩm.

Tin tức / Blog

- GET /tin-tuc - Danh sách tin tức.
- GET /tin-tuc/{slug} - Tin tức theo danh mục.
- GET /tin-tuc/chi-tiet/{id} - Chi tiết tin tức.

Yêu thích (Favorites) (middleware: auth)

- GET /favorites/add/{productId} - Thêm sản phẩm yêu thích.
- GET /favorites - Danh sách sản phẩm yêu thích.
- DELETE /favorites/{id} - Xóa sản phẩm khỏi danh sách.

Giỏ hàng

- POST /cart/add - Thêm sản phẩm vào giỏ.
- GET /gio-hang - Hiển thị giỏ hàng.
- POST /cart/update - Cập nhật giỏ hàng.
- DELETE /cart/remove/{id} - Xóa sản phẩm khỏi giỏ.

Thanh toán

- GET /thanh-toan - Hiển thị trang thanh toán.
- POST /xu-ly-thanh-toan - Xử lý thanh toán.
- Cổng thanh toán:
  - POST /vnpay_payment - Thanh toán VNPAY.
  - POST /cod_payment - Thanh toán COD.

Đơn hàng

- GET /don-hang-cua-toi - Hiển thị đơn hàng của người dùng.
- GET /don-hang/{id} - Chi tiết đơn hàng.

Tài khoản

- GET /tai-khoan - Hiển thị trang tài khoản.
- POST /tai-khoan/update/{id} - Cập nhật thông tin tài khoản.
- GET /tai-khoan/doi-mat-khau - Hiển thị form đổi mật khẩu.
- POST /tai-khoan/doi-mat-khau - Xử lý đổi mật khẩu.

1. Admin Routes

Chức năng Đăng nhập và Đăng ký

- GET /admin/dang-nhap - Hiển thị form đăng nhập.
- POST /admin/xu-ly-dang-nhap - Xử lý đăng nhập.
- GET /admin/dang-xuat - Đăng xuất (middleware: auth).

Dashboard

- GET /admin - Trang chủ Admin.
- GET /admin/test - Route test.

Quản lý Banners

- Danh sách, thêm, sửa, xóa, cập nhật trạng thái banner.

Quản lý Menu

- Danh sách, thêm, sửa, xóa menu.

Quản lý Tài Khoản

- Danh sách tài khoản, thêm mới, xem chi tiết, sửa, xóa, xóa nhiều.

Quản lý Loại Bài Viết

- Danh sách, thêm, sửa, xóa loại bài viết.

Quản lý Bài Viết

- Danh sách bài viết, thêm mới, xem chi tiết, sửa, xóa, xóa nhiều.

Quản lý Danh Mục Sản Phẩm

- Danh sách, thêm, sửa, xóa, cập nhật trạng thái danh mục.

Quản lý Sản Phẩm

- Danh sách sản phẩm, thêm mới, xem chi tiết, sửa, xóa, xóa nhiều.

Quản lý Thuộc Tính

- Danh sách, thêm, sửa, xóa, cập nhật trạng thái thuộc tính.

Quản lý Hóa Đơn

- Danh sách hóa đơn, xem chi tiết, cập nhật trạng thái.

Quản lý Voucher

- Danh sách, thêm mới, sửa, xóa voucher.

Quản lý Giảm Giá

- Danh sách, thêm mới, sửa, xóa, xóa nhiều giảm giá.

Middleware và Prefix

- Middleware: auth, authUser:1 (chỉ cho admin).
- Prefix: /admin cho các route quản trị viên.

Tổng Kết

- Client Routes: Tập trung vào chức năng đăng nhập, quản lý tài khoản, sản phẩm, giỏ hàng, thanh toán và tin tức.
- Admin Routes: Quản lý toàn bộ nội dung và chức năng hệ thống như sản phẩm, danh mục, bài viết, hóa đơn, voucher và giảm giá.
- Client Routes: Tập trung vào chức năng đăng nhập, quản lý tài khoản, sản phẩm, giỏ hàng, thanh toán và tin tức.
- Admin Routes: Quản lý toàn bộ nội dung và chức năng hệ thống như sản phẩm, danh mục, bài viết, hóa đơn, voucher và giảm giá.
