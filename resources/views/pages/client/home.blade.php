@extends('layouts.client.main')
@section('content')
    @include('components.client.alert')
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($banners as $key => $banner)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : '' }}"
                    aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($banners as $key => $banner)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('images/' . $banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Carousel cho sản phẩm giảm giá -->
    <div class="bg-danger">
    <div class="container sale-home">
        <h4 class="m-0 title-sale py-3">SẢN PHẨM KHUYẾN MÃI</h3>
        <div class="owl-carousel owl-theme">
            @foreach ($discountedProducts as $product)
                <div class="item">
                    <div class="card bg-hove position-relative">
                        <a href="{{ route('productsClient.show', $product->id) }}">
                            <div class="product-img">
                                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <a href="{{ route('productsClient.show', $product->id) }}"
                                class="text-decoration-none text-dark-custom product-name">
                                {{ $product->name }}

                                @if ($product->old_price && $product->old_price > $product->price)
                                    @php
                                        $discountPercentage = round((($product->old_price - $product->price) / $product->old_price) * 100);
                                    @endphp
                                    <div
                                        class="position-absolute top-0 end-0 bg-danger text-white text-center p-2 rounded-start">
                                        -{{ $discountPercentage }}%
                                    </div>
                                @endif
                            </a>
                            <div class="product-price-wrapper">
                                <p class="card-text m-0">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                                @if ($product->old_price && $product->old_price > $product->price)
                                    <div class="price-sale">
                                        <del class="product-old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</del>
                                    </div>
                                @else
                                    <div class="price-sale empty-sale"></div>
                                @endif
                            </div>
                            <div
                                class="product-btn d-flex flex-column flex-sm-row justify-content-center align-items-center">
                                <a href="{{ route('productsClient.show', $product->id) }}"
                                    class="text-decoration-none mb-2 mb-sm-0">
                                    <button class="btn btn-danger me-md-1">
                                        <i class="fa fa-shopping-cart me-1"></i>
                                    </button>
                                </a>

                                <a href="{{ route('favorites.add', $product->id) }}" class="text-decoration-none">
                                    <button class="btn btn-secondary">
                                        <i class="fas fa-heart me-1 ms-md-1"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <!-- Carousel cho sản phẩm hot -->
   <div class="container my-4">
    <h4 class="title mb-1">BEST SELLER</h4>
    <div class="owl-carousel owl-theme">
        @foreach ($hotProducts as $product)
            <div class="item">
                <div class="card position-relative">
                    <a href="{{ route('productsClient.show', $product->id) }}">
                        <div class="product-img">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        </div>
                    </a>

                    @if ($product->old_price && $product->old_price > $product->price)
                        @php
                            $discountPercentage = round((($product->old_price - $product->price) / $product->old_price) * 100);
                        @endphp
                        <div class="position-absolute top-0 end-0 bg-danger text-white text-center p-2 rounded-start discount-badge" style="z-index: 10;">
                            -{{ $discountPercentage }}%
                        </div>
                    @endif

                    <div class="card-body text-center d-flex flex-column justify-content-between h-100">
                        <a href="{{ route('productsClient.show', $product->id) }}" class="text-decoration-none text-dark-custom product-name">
                            {{ $product->name }}
                        </a>
                        <div class="product-price-wrapper">
                            <p class="card-text m-0">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                            @if ($product->old_price && $product->old_price > $product->price)
                                <div class="price-sale">
                                    <del class="product-old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</del>
                                </div>
                            @else
                                <div class="price-sale empty-sale"></div>
                            @endif
                        </div>
                       <div
                                class="product-btn d-flex flex-column flex-sm-row justify-content-center align-items-center">
                                <a href="{{ route('productsClient.show', $product->id) }}"
                                    class="text-decoration-none mb-2 mb-sm-0">
                                    <button class="btn btn-danger me-md-1">
                                        <i class="fa fa-shopping-cart me-1"></i>
                                    </button>
                                </a>

                                <a href="{{ route('favorites.add', $product->id) }}" class="text-decoration-none">
                                    <button class="btn btn-secondary">
                                        <i class="fas fa-heart me-1 ms-md-1"></i>
                                    </button>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <!-- Sản phẩm theo loại -->
    <!--@foreach ($categories as $category)
        <div class="container my-4">
            <h4 class="title mb-1">{{ $category->name }}</h4>
            <div class="owl-carousel owl-theme">
                @foreach ($categoryProducts[$category->name] as $product)
                    <div class="item">
                        <div class="card">
                            <a href="{{ route('productsClient.show', $product->id) }}">
                                <div class="product-img">
                                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <a href="{{ route('productsClient.show', $product->id) }}"
                                    class="text-decoration-none text-dark-custom product-name">
                                    {{ $product->name }}
                                </a>
                                <div class="product-price-wrapper">
                                   <div class="product-price-wrapper">
                                        <p class="card-text m-0">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                                        
                                        @if ($product->old_price)
                                            <div class="price-sale">
                                                <del class="product-old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</del>
                                            </div>
                                        @else
                                            <div class="price-sale empty-sale"></div>
                                        @endif
                                    </div>

                                <div
                                    class="product-btn d-flex flex-column flex-sm-row justify-content-center align-items-center">
                                    <a href="{{ route('productsClient.show', $product->id) }}"
                                        class="text-decoration-none mb-2 mb-sm-0">
                                        <button class="btn btn-danger me-md-1">
                                            <i class="fa fa-shopping-cart me-1"></i>
                                        </button>
                                    </a>

                                    <a href="{{ route('favorites.add', $product->id) }}" class="text-decoration-none">
                                        <button class="btn btn-secondary">
                                            <i class="fas fa-heart me-1 ms-md-1"></i>
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center my-3">
                <a href="{{ route('productsClient.productByCategory', ['slug' => $category->slug]) }}"
                    class="btn btn-danger">Xem tất cả</a>
            </div>
        </div>
    @endforeach
-->
    <!-- Carousel cho tất cả sản phẩm -->
   <div class="container my-4">
    <h4 class="title mb-1">Tất cả sản phẩm</h4>
    <div class="owl-carousel owl-theme">
        @foreach ($allProducts as $product)
            <div class="item">
                <div class="card position-relative">
                    <a href="{{ route('productsClient.show', $product->id) }}">
                        <div class="product-img">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                        </div>
                    </a>

                    @if ($product->old_price && $product->old_price > $product->price)
                        @php
                            $discountPercentage = round((($product->old_price - $product->price) / $product->old_price) * 100);
                        @endphp
                        <div
                            class="position-absolute top-0 end-0 bg-danger text-white text-center p-2 rounded-start"
                            style="z-index: 10;">
                            -{{ $discountPercentage }}%
                        </div>
                    @endif

                    <div class="card-body text-center">
                        <a href="{{ route('productsClient.show', $product->id) }}"
                            class="text-decoration-none text-dark-custom product-name">
                            {{ $product->name }}
                        </a>
                        <div class="product-price-wrapper">
                            <p class="card-text m-0">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                            @if ($product->old_price && $product->old_price > $product->price)
                                <div class="price-sale">
                                    <del class="product-old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</del>
                                </div>
                            @else
                                <div class="price-sale empty-sale"></div>
                            @endif
                        </div>
                        <div
                            class="product-btn d-flex flex-column flex-sm-row justify-content-center align-items-center">
                            <a href="{{ route('productsClient.show', $product->id) }}"
                                class="text-decoration-none mb-2 mb-sm-0">
                                <button class="btn btn-danger me-md-1">
                                    <i class="fa fa-shopping-cart me-1"></i>
                                </button>
                            </a>

                            <a href="{{ route('favorites.add', $product->id) }}" class="text-decoration-none">
                                <button class="btn btn-secondary">
                                    <i class="fas fa-heart me-1 ms-md-1"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
