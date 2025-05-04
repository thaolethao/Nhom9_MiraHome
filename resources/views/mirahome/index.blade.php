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
    <link rel="stylesheet" href="{{ asset('mirahome/css/sanpham.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <a href="#" class="cart ml-3 position-relative">
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

            <!-- SLIDER -->
            <div id="home-slide" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="2000">
                        <a href="#"><img src="{{ asset('mirahome/img/slider_1.webp') }}" alt="Slide 1" class="d-block w-100"></a>
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <a href="#"><img src="{{ asset('mirahome/img/slider_2.webp') }}" alt="Slide 2" class="d-block w-100"></a>
                    </div>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#home-slide" data-slide-to="0" class="active"></li>
                    <li data-target="#home-slide" data-slide-to="1"></li>
                </ol>
            </div>
            <!-- END SLIDER -->

            <!-- SALE PRODUCTS -->
                <!-- Phần hiển thị sản phẩm -->
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold">SẢN PHẨM</h2>
        </div>
        
        <!-- Khu vực hiển thị sản phẩm -->
        <div id="product-list" class="row">
            <!-- Loading indicator -->
            <div class="col-12 text-center my-5" id="loading-indicator">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Đang tải sản phẩm...</p>
            </div>
        </div>
    </section>
<!-- JavaScript -->
<script>
    let currentPage = 1;

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN', { 
            style: 'currency', 
            currency: 'VND' 
        }).format(price);
    }

    function loadProducts(page = 1) {
        $.ajax({
            url: '/api/products?page=' + page,
            method: 'GET',
            beforeSend: function () {
                $('#loading-indicator').show();
            },
            success: function (response) {
                let html = '';
                let products = response.data;

                if (products.length > 0) {
                    products.forEach(function (product) {
                        html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="product-card">
                                <img src="${product.image}" 
                                     class="product-img" 
                                     alt="${product.name}"
                                     onerror="this.src='{{ asset('mirahome/img/default-product.jpg') }}'">
                                <div class="p-3">
                                    <h5 class="mb-2">${product.name}</h5>
                                    <div class="price-section">
                                        <span class="current-price">${formatPrice(product.price)}</span>
                                        ${product.old_price ? `<span class="old-price">${formatPrice(product.old_price)}</span>` : ''}
                                    </div>
                                    <span class="badge badge-success stock-badge">Còn ${product.stock} sản phẩm</span>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-primary add-to-cart" data-id="${product.id}">
                                            <i class="fas fa-cart-plus"></i> Thêm giỏ hàng
                                        </button>
                                        <a href="/products/${product.id}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-eye"></i> Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    // Thêm phân trang
                    html += '<div class="col-12 mt-4 d-flex justify-content-center">';
                    html += '<nav><ul class="pagination">';

                    if (response.current_page > 1) {
                        html += `<li class="page-item"><a class="page-link" href="#" data-page="${response.current_page - 1}">Trước</a></li>`;
                    }

                    for (let i = 1; i <= response.last_page; i++) {
                        html += `<li class="page-item ${i === response.current_page ? 'active' : ''}">
                                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                                 </li>`;
                    }

                    if (response.current_page < response.last_page) {
                        html += `<li class="page-item"><a class="page-link" href="#" data-page="${response.current_page + 1}">Sau</a></li>`;
                    }

                    html += '</ul></nav></div>';
                } else {
                    html = '<div class="col-12 text-center"><p>Không có sản phẩm nào</p></div>';
                }

                $('#product-list').html(html);
            },
            error: function (xhr, status, error) {
                console.error('Lỗi khi tải sản phẩm:', error);
                $('#product-list').html(`
                    <div class="col-12 text-center error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Đã xảy ra lỗi khi tải sản phẩm. Vui lòng thử lại sau.</p>
                        <button class="btn btn-sm btn-outline-primary retry-btn">
                            <i class="fas fa-sync-alt"></i> Thử lại
                        </button>
                    </div>
                `);
            },
            complete: function () {
                $('#loading-indicator').hide();
            }
        });
    }

    // Khi document ready
    $(document).ready(function () {
        loadProducts(currentPage); // Gọi trang đầu

        // Phân trang
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            const page = $(this).data('page');
            if (page && page !== currentPage) {
                currentPage = page;
                loadProducts(currentPage);
            }
        });

        // Nút thử lại khi lỗi
        $(document).on('click', '.retry-btn', function () {
            loadProducts(currentPage);
        });

        /// cập nhật danh sách theo thời gian thực
     // Cập nhật sản phẩm định kỳ mỗi 30 giây
     setInterval(function () {
        loadProducts(currentPage);
    }, 30000); // 30000 ms = 30 giây

        // Demo thêm giỏ hàng
        $(document).on('click', '.add-to-cart', function () {
            const productId = $(this).data('id');
            alert('Đã thêm sản phẩm ID ' + productId + ' vào giỏ hàng');
            // Có thể thêm AJAX xử lý ở đây nếu cần
        });
    });

    
</script>

           <!-- END SALE PRODUCTS -->

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
