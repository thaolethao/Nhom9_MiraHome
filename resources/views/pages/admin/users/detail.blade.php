@extends ('layouts.admin.main')

@section('content')
    @include('components.admin.alert')

    <div class="container ">
        <div class="row">
            

            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class=" d-flex justify-content-between">
                    <div class="row gx-4 mb-2">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ $user->image ? asset('images/' . $user->image) : asset('images/no_images.jpg') }}"
                                    class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ $user->name }}
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    @if ($user->role == 2)
                                        Khách hàng
                                    @elseif($user->role == 1)
                                        Quản trị
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="me-3">
                        <a href="{{ route('user.index') }}"><button type="button"
                                class="btn btn-primary text-capitalize ">
                                Danh sách 
                            </button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-7 d-flex align-items-center">
                                        <h6 class="mb-0">Thông tin cá nhân</h6>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body p-3">
                                <p class="text-sm">
                                
                                </p>
                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Họ và
                                            tên:</strong> &nbsp;</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Số điện
                                            thoại:</strong> &nbsp; </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">Email:</strong> &nbsp; ADMIN@gmail.com</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Địa
                                            chỉ:</strong> &nbsp;  </li>
                                    <li class="list-group-item border-0 ps-0 pb-0">
                                        <strong class="text-dark text-sm">Mạng xã hội:</strong> &nbsp;
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-facebook fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
             
                @endsection
