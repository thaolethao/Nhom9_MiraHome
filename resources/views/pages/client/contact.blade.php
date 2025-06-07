@extends ('layouts.client.main')
@section('content')
    @include('components.client.alert')
    <div class="container ">
        @include('breadcrumbs::bootstrap4')
        <!-- section title -->
        <div class="col-md-12 ">
            <div class="section-title my-4 ms-3">
                <h3 class="title">Liên hệ</h3>
            </div>
        </div>
        <!-- /section title -->
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="fshop-contact-form">
                    <p>Địa chỉ: 171 P. Chùa Bộc, Trung Liệt, Đống Đa, Hà Nội</p>
                    <p>Điện thoại: 0333468730</p>
                    <form id="form-contact" class="form" novalidate="novalidate">
                        <p>Đừng ngần ngại, hãy liên hệ ngay với chúng tôi </p>
                        <p>
                            <input type="text" name="name" value="" placeholder="Họ và tên"
                                class="name form-control" data-rule-required="true" aria-required="true">
                        </p>
                        <p>
                            <input type="text" name="phone" value="" placeholder="Số điện thoại của bạn"
                                class="phone form-control" data-rule-required="true" aria-required="true">
                        </p>
                        <p>
                            <input type="text" name="emailCustomer" value="" placeholder="Email của bạn"
                                class="emailCustomer form-control" data-rule-required="true" aria-required="true">
                        </p>
                        <p>
                            <textarea class="content form-control" name="content" placeholder="Nội dung cần liên hệ" data-rule-required="true"
                                aria-required="true"></textarea>
                        </p>
                        <p>
                            <select class="emailContact form-control" id="emailContact" name="emailContact">
                                <option value="frt.sale@fpt.com.vn">Bộ phận hỗ trợ bán hàng</option>
                                <option value="frt.contact@fpt.com.vn">Bộ phần hỗ trợ tài khoản, các vấn đề khác </option>
                                <option value="fptshop@fpt.com.vn">Bộ phận hỗ trợ phản ánh, góp ý </option>
                            </select>
                        </p>
                        <p class="text-right">
                            <input type="submit" value="Gửi đi" class="btn btn-danger">
                        </p>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class=" row fshop-contact-maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3131.997930060586!2d105.82382458431775!3d21.0088968376968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac8046f22ed1%3A0x77ebeaba9a3f89f6!2zMTcxIFAuIENow7lhIELhu5ljLCBUcnVuZyBMaeG7h3QsIMSQ4buRbmcgxJBhLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1748389025602!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
