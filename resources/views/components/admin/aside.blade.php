<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a href="/" class="logo text-decoration-none">
            <img src="{{ asset('images/2_logo.png') }}" alt="Mira Home Logo" style="height: 80px;">
        </a>

    </div>


    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>

                    <span class="nav-link-text ms-1">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('admin.orders.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1"> ĐƠN HÀNG
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/danh-muc/danh-sach') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1">DANH MỤC SẢN PHẨM </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/san-pham') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1">SẢN PHẨM</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('vouchers.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1">VOUCHER</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/thuoc-tinh/danh-sach') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1">THUỘC TÍNH SẢN PHẨM</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/bai-viet/danh-sach') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1"> TIN TỨC
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/banners/danh-sach') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>

                    <span class="nav-link-text ms-1">BANNER</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/menu/danh-sach') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>

                    <span class="nav-link-text ms-1">Menu</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ url('/admin/tai-khoan/danh-sach') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    </div>
                    <span class="nav-link-text ms-1"> TÀI KHOẢN
                    </span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
