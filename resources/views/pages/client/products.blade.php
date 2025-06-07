@extends ('layouts.client.main')
@section('content')
    @include('components.client.alert')

    <div class="container mt-5">
        <div class="row">
            <!-- Danh mục sản phẩm cho desktop -->
            <div class="col-md-3 col-sm-6 d-none d-md-block border-end">
                <aside>
                    <div class="card categories-vertical">
                        <ul class="list-group btn-danger-custom">
                            <div class="card-header fw-bold text-uppercase">
                                <i class="fas fa-list-ul me-2"></i>Danh mục sản phẩm
                            </div>
                            <a href="{{ route('productsClient.productByCategory') }}"
                                class="list-group-item list-group-item-action">Tất Cả</a>
                            @foreach ($categories as $category)
                                <a href="{{ route('productsClient.productByCategory', ['slug' => $category->slug]) }}"
                                    class="list-group-item list-group-item-action">{{ $category->name }}</a>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>

            <!-- Danh mục sản phẩm cho mobile -->
            <div class="col-12 d-md-none">
                <div class="filter-cate">
                    <div class="ft-cate d-flex overflow-auto">
                        <a href="{{ route('productsClient.productByCategory') }}" data-id="0" class="active">
                            Tất cả
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('productsClient.productByCategory', ['slug' => $category->slug]) }}"
                                data-id="{{ $category->id }}" class="">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="col-md-9 col-sm-12 ps-0">
                <div class="row g-3 mb-3">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <div class="card rounded-0 bg-hove">
                                <a href="{{ route('productsClient.show', $product->id) }}">
                                    <div class="product-img">
                                        <img src="{{ asset('images/' . $product->image) }}"
                                            class="card-img-top img-fluid" alt="{{ $product->name }}">
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
                                            <div class="position-absolute top-0 end-0 bg-danger text-white text-center p-2 rounded-start discount-badge" style="z-index: 10;">
                                                -{{ $discountPercentage }}%
                                            </div>
                                        @endif
                                    </a>
                                    <div class="product-price-wrapper">
                                        <p class="card-text m-0">{{ $product->price_range }}</p>
                                        @if ($product->old_price)
                                            <div class="price-sale">
                                                <del class="product-old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</del>
                                            </div>
                                        @else
                                            <div class="price-sale empty-sale"></div>
                                        @endif
                                    </div>
                                    <div class="product-btn d-flex flex-column flex-sm-row justify-content-center align-items-center mt-2">
                                        <a href="{{ route('productsClient.show', $product->id) }}" class="text-decoration-none mb-2 mb-sm-0">
                                            <button class="btn btn-danger me-sm-2">
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
                    @empty
                        <div class="col-12 text-center py-5">
                            <img src="{{ asset('images/no-products.png') }}" alt="Không có sản phẩm" class="img-fluid mb-3" style="max-height: 200px;">
                            <h5>Không tìm thấy sản phẩm nào.</h5>
                            <p>Vui lòng thử từ khóa khác hoặc chọn danh mục khác.</p>
                            <a href="{{ route('productsClient.productByCategory') }}" class="btn btn-outline-secondary mt-2">Quay về trang sản phẩm</a>
                        </div>
                    @endforelse
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
