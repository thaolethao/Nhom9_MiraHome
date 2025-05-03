<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mira Home</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('mirahome/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mirahome/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mirahome/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mirahome/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('mirahome/css/grid-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('mirahome/css/fontawesome/css/all.css') }}">
</head>

<body>
<div id="wrapper">
    <!-- HEADER -->
    <header id="header">
        <!-- TOP HEADER -->
        <div id="top-header" class="py-2 bg-light">
            <div class="container">
                <div class="row text-center text-md-left">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <i class="fa-regular fa-clock"></i> Thứ 2 - Chủ nhật: 7:00am - 20:00pm
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <i class="fa-regular fa-envelope"></i> mirahome@gmail.com
                    </div>
                    <div class="col-md-4">
                        <i class="fa-solid fa-phone"></i> 0333468730
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP HEADER -->

        <!-- BOTTOM HEADER -->
        <div id="bottom-header" class="py-3">
            <div class="container">
                <nav class="d-flex justify-content-between align-items-center" id="home-nav">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img src="{{ asset('mirahome/img/2_logo.png') }}" alt="logo" width="90" height="90">
                    </a>
                    <ul id="main-menu" class="list-unstyled mb-0 d-flex">
                        <li class="menu-item"><a href="{{ url('/') }}">TRANG CHỦ</a></li>
                        <li class="menu-item"><a href="#">GIỚI THIỆU</a></li>
                        <li class="menu-item has-child">
                            <a href="#">SẢN PHẨM</a>
                            <ul class="sub-menu shadow">
                                <li><a href="#">Dụng cụ nấu ăn</a></li>
                                <li><a href="#">Dụng cụ bàn ăn</a></li>
                                <li><a href="#">Thiết bị gia dụng</a></li>
                                <li><a href="#">Phụ kiện bếp</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="#">LIÊN HỆ</a></li>
                    </ul>
                    <div class="wp-search-cart d-flex align-items-center">
                        <form action="#" class="d-flex">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <button class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <a href="{{ url('/cart') }}" class="cart ml-3 position-relative">
                            <i class="fa-solid fa-cart-plus"></i>
                            <span class="num-product-cart badge badge-danger">2</span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END BOTTOM HEADER -->
    </header>

    <div id="wp-content" >
            <div class="container py-4">
                <nav aria-label="breadcrumb" class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                      <li class="breadcrumb-item">Thanh toán</li>
                    </ol>
                  </nav>
                  <div class="container mt-5">
                    <h2 class="text-center mb-4 checkout"> Thông Tin Thanh Toán</h2>
                    <div class="row">
                        <!-- Thông tin khách hàng -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Thông Tin Khách Hàng</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Nhập email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                                            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ giao hàng" required>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                
                        <!-- Thông tin thanh toán -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">Phương Thức Thanh Toán</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('confirm-momo') }}" method="POST">
                                        @csrf {{-- Bảo mật CSRF --}}
                                        
                                        <label>
                                            <input type="radio" name="payment_method" value="wallet" checked>
                                            <img src="{{ asset('mirahome/img/MoMo_Logo.png') }}" alt="Momo" style="width:20px; height:auto; vertical-align:middle; margin-right:5px;">
                                            Ví điện tử Momo
                                        </label>
                                    
                                        <div class="mb-3 mt-2">
                                            <label for="totalAmount" class="form-label">Tổng tiền</label>
                                            {{-- <input type="text" class="form-control" id="totalAmount" value="{{ number_format($total, 0, ',', '.') }} VND" readonly> --}}
                                            {{-- <input type="hidden" name="total" value="{{ $total }}"> --}}
                                            <input type="text" class="form-control" id="totalAmount" value="10,000 VND" readonly>
                                            <input type="hidden" name="total" value="10000">
                                        </div>
                                    
                                        <button type="submit" name="payUrl" class="btn btn-block" style="background-color: #dda165; color: #fff;">
                                            Thanh Toán
                                        </button>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
            <!-- end wp-content  -->

     <!-- footer -->
     <div id="footer" class="text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <!-- begin box-address -->
                        <div class="box box-address">
                            <div class="box-head">
                                <h6>ĐỊA CHỈ</h6>
                            </div>
                            <div class="box-body">
                                <ul id="list-address" class="p-0 m-0 list-unstyled">
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1"><i class="fa-solid fa-location-dot"></i>&nbsp;171 P. Chùa Bộc, Trung Liệt, Đống Đa, Hà Nội</a>
                                    </li>
                                    <li class="list-item py-1">
                                        <div class="phone"><i class="fa-solid fa-phone"></i>&nbsp;0333468730</div>
                                    </li>
                                    <li class="list-item">
                                        <a href="" class="phone py-1 d-block text text-decoration-none text-light"><i class="fa-regular fa-envelope"></i>&nbsp;mirahome@gmail.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end box-address -->
                    </div>
                    <div class="col-md-3">
                        <!-- begin box-introduce -->
                        <div class="box box-introduce">
                            <div class="box-head">
                                <h6>HỖ TRỢ KHÁCH HÀNG</h6>
                            </div>
                            <div class="box-body">
                                <ul id="list-introduce" class="p-0 m-0 list-unstyled">
                                    <li class="list-item">
                                        <a href="" class="text-decoration-none text-light d-block py-1">Tìm kiếm</a>
                                    </li>
                                    <li class="list-item py-1">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Đăng nhập</a>
                                    </li>
                                    <li class="list-item py-1">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Đăng kí</a>
                                    </li>
                                    <li class="list-item py-1">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Giỏ hàng</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end box-introduce -->
                         
                    </div>
                    <div class="col-md-3">
                        <!-- begin box-category -->
                        <div class="box box-category">
                            <div class="box-head">
                                <h6>CHÍNH SÁCH</h6>
                            </div>
                            <div class="box-body">
                                <ul id="list-category" class="p-0 m-0 list-unstyled">
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Chính sách bảo mật</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Chính sách vận chuyển</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Chính sách đổi trả</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Hướng dẫn mua hàng</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Hướng dẫn thanh toán</a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#" class="text-decoration-none text-light d-block py-1">Điều khoản</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end box-category -->
                    </div>
                    <div class="col-md-3">
                        <!-- begin box-social -->
                        <div class="box box-social">
                            <div class="box-head">
                                <h6>SOCIAL</h6>
                            </div>
                            <div class="box-body">
                                <ul id="list-social" class="p-0 m-0 list-unstyled">
                                    <li class="list-item"><a href="#" class="text-decoration-none text-light"><i class="fa-brands fa-facebook"></i></a>   Facebook</li>
                                    <li class="list-item"><a href="#" class="text-decoration-none text-light"><i class="fa-brands fa-instagram"></i></a>  Instagram</li>
                                </ul>
                            </div>
                        </div>
                        <!-- end box-social -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end footer -->
    </div>
    </footer>
</div>



</body>
</html>
