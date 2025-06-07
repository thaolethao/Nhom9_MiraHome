@extends ('layouts.admin.main')
@section('content')
    @include('components.admin.alert')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-dark shadow-danger border-radius-lg pt-4 pb-3 d-flex flex-column flex-md-row align-items-center justify-content-between choose">
                            <h5 class="text-white text-capitalize ps-3">Chỉnh Sửa Tin Tức</h5>
                            <a href="{{ route('post.index') }}" class="btn btn-success text-capitalize me-md-4 mb-2 mb-md-0 green-bg">
                                Danh sách
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 mx-3">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="p-3">
                                    <form id="postEditForm" action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Sử dụng phương thức PUT để cập nhật bài viết -->

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Tiêu đề</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Tác giả</label>
                                            <select class="form-select" id="user_id" name="user_id">
                                                @foreach ($authors as $id => $name)
                                                    <option value="{{ $id }}" @if (old('user_id', $post->user_id) == $id) selected @endif>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea class="form-control" id="description" name="description">{{ old('description', $post->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Nội dung</label>
                                            <textarea id="editor" name="content">{{ old('content', $post->content) }}</textarea>
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Ảnh</label>
                                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trạng thái</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="active" name="status" value="1" @if (old('status', $post->status) == 1) checked @endif>
                                                <label class="form-check-label" for="active">Hiển thị</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="inactive" name="status" value="0" @if (old('status', $post->status) == 0) checked @endif>
                                                <label class="form-check-label" for="inactive">Ẩn</label>
                                            </div>
                                            @error('status')
                                                <br><span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('post.index') }}"><button type="button" class="btn btn-secondary me-2">Hủy</button></a>
                                            <button type="submit" class="btn btn-primary choose">Cập Nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <img id="previewImage" class="w-100" src="{{ asset('images/' . $post->image) }}" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('previewImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function toSlug(str) {
            str = str.toLowerCase();
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/\s+/g, '-');
            str = str.replace(/[^\w\-]+/g, '');
            str = str.replace(/\-\-+/g, '-');
            str = str.replace(/^-+/, '').replace(/-+$/, '');
            return str;
        }

        document.getElementById('title').addEventListener('input', function() {
            var title = this.value;
            var slug = toSlug(title);
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
