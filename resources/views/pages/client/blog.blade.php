@extends ('layouts.client.main')
@section('content')
    @include('components.client.alert')
    <div class="container">
        @include('breadcrumbs::bootstrap4')

        {{-- Tất cả tin tức --}}
        <div class="row mt-3">
            <div class="col-12">
                <div class="row g-3 w-100">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="col-xl-4 col-md-6 col-sm-6 col-6">
                                <div class="blog">
                                    <div class="img">
                                        <a href="{{ route('blog.show', $post->id) }}">
                                            <img width="100%" class="card"
                                                src="{{ $post->image ? asset('images/' . $post->image) : asset('images/no_images.jpg') }}"
                                                alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                    <div class="blog-info">
                                        {{-- Bỏ category --}}
                                        <a href="{{ route('blog.show', $post->id) }}">
                                            <h6 class="title title-post">{{ $post->title }}</h6>
                                        </a>
                                        <div class="author d-flex align-items-center">
                                            <div class="name">
                                                <div class="d-flex">
                                                    <span>{{ $post->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mt-3">Không có tin tức nào phù hợp.</p>
                    @endif
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        
@endsection
