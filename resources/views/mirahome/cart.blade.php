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

        <!-- CONTENT -->
        <main id="wp-content">
            <div id="content">

                <!-- end header  -->
                <div id="content">
                    <div class="wp-nav">
                        <nav aria-label="breadcrumb" id="breadcrumb-nav" class="container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}" style="color:#412529;">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><span>Giỏ hàng</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="container wp-cart mb-5 mt-3">
                        <h2 class="text-left px-2 py-3 title">Giỏ hàng 
                            <span class="num">({{ $cart->items->count() }} sản phẩm)</span> 
                        </h2>
                        
                        @foreach($cart->items as $item)
                        <div class="card mb-4">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-2 col-sm-4 col-4">
                                    <img src="{{ asset($item->product->image) }}" class="card-img product-img" alt="Product Image">
                                </div>
                                <div class="col-md-10 col-sm-8 col-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="#" class="name">{{ $item->product->name }}</a>
                                        </h5>
                                        <div class="space-price">
                                            <span class="mr-3">Giá tiền:
                                                <strong class="font-weight color-price-red">{{ number_format($item->price, 0, ',', '.') }}đ</strong>
                                            </span>
                                            <span class="">Thành tiền: 
                                                <strong class="font-weight color-price-red">
                                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ
                                                </strong>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="quantity-control" data-url="">
                                                <button class="btn-decrease">-</button>
                                                <input type="number" class="form-control form-control-sm qty"
                                                       value="{{ $item->quantity }}" min="1" data-id="{{ $item->id }}">
                                                <button class="btn-increase">+</button>
                                            </div>
                                            <a href="{{ url('/cart/delete/'.$item->id) }}" class="btn btn-danger ml-2 btn-sm">Xóa</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        


                        <!-- Repeat for more products -->
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Hóa đơn của bạn</h3>
                                <div class="space-provisional">
                                    Tạm tính: <strong class="card-text font-weight" id="total-provisional">
                                        {{ number_format($total, 0, ',', '.') }}đ
                                    </strong>
                                </div>
                                <!-- ... -->
                                <div class="space-total">
                                    Tổng cộng: <strong class="card-text text-total" id="total-price">
                                        {{ number_format($total, 0, ',', '.') }}đ
                                    </strong>
                                </div>                                
                                

                                <a href="{{ route('checkout', ['total' => $total]) }}" class="btn btn-primary">Tiến hành thanh toán</a>
                            </div>
                        </div>
                    </div>


                </div>
        </main>

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
                                    <li class="list-item"><a href="#" class="text-decoration-none text-light"><i class="fa-brands fa-facebook"></i></a> Facebook</li>
                                    <li class="list-item"><a href="#" class="text-decoration-none text-light"><i class="fa-brands fa-instagram"></i></a> Instagram</li>
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