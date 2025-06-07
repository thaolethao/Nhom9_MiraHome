@extends ('layouts.admin.main')

@section('content')
    @include('components.admin.alert')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark shadow-danger border-radius-lg pt-4 pb-3 d-flex flex-column flex-md-row align-items-center justify-content-between choose padding-right">
                            <h5 class="text-white text-capitalize ps-3">{{ $title }}</h5>
                            <div class="d-flex flex-column flex-md-row">
                                <!-- Form tìm kiếm -->
                                <form id="searchForm" action="{{ route('post.index') }}" method="GET" class="d-flex mb-2 mb-md-0 me-md-3">
                                    <div class="input-group input-group-outline">
                                        <input id="searchInput" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                                    </div>
                                </form>
                            
                                <a href="{{ route('post.create') }}" class="btn btn-success text-capitalize mb-0 green-bg">Thêm mới</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mx-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    @if ($posts->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Chưa có tin tức</td>
                                        </tr>
                                    @else
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><input type="checkbox" id="select-all"></th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tác giả</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-0">Tiêu đề</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td><input type="checkbox" class="post-checkbox ms-3" value="{{ $post->id }}"></td>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div>
                                                            <img src="{{ $post->author->image ? asset('images/' . $post->author->image) : asset('images/no_images.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $post->author->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $post->author->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('post.show', $post->id) }}" class="text-xs font-weight-bold mb-0 ellipsis">{{ $post->title }}</a>
                                                </td>
                                               
                                                <td class="text-center text-sm">
                                                    <button class="btn btn-sm mb-0 {{ $post->status == 1 ? 'btn-success' : 'btn-danger' }}" data-id="{{ $post->id }}" data-status="{{ $post->status }}">
                                                        {{ $post->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('post.edit', $post->id) }}">
                                                            <button type="button" class="btn btn-warning text-capitalize text-xs mb-0 me-2 choose">Sửa</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="ms-3 mt-3">
                                <button id="select-all-btn" class="btn btn-primary p-2 me-3 choose">Chọn tất cả</button>
                                <button id="delete-selected" class="btn btn-primary p-2 choose">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Chọn tất cả checkbox khi bấm vào nút "Chọn tất cả"
            document.getElementById('select-all-btn').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.post-checkbox');
                const selectAll = document.getElementById('select-all');
                const isChecked = !selectAll.checked;

                checkboxes.forEach((checkbox) => {
                    checkbox.checked = isChecked;
                });

                selectAll.checked = isChecked;
            });
            // Chọn tất cả checkbox
            document.getElementById('select-all').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.post-checkbox');
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });

            // Xóa các sản phẩm đã chọn
            document.getElementById('delete-selected').addEventListener('click', function() {
                const selectedPosts = [];
                document.querySelectorAll('.post-checkbox:checked').forEach((checkbox) => {
                    selectedPosts.push(checkbox.value);
                });

                if (selectedPosts.length > 0) {
                    if (confirm('Bạn có chắc chắn muốn xóa các tin tức đã chọn?')) {
                        fetch('{{ route('posts.bulkDelete') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: selectedPosts
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                                }
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    }
                } else {
                    alert('Vui lòng chọn ít nhất một tin tức để xóa.');
                }
            });
        });
    </script>
@endsection
