@extends('layouts.user')
@section('title', 'تنظیمات پروفایل')
@section('style')
    <link href="/assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet"/>
    <link href="/assets/js/bundles/multiselect/css/multi-select.css" rel="stylesheet">
    <link href="/assets/css/form.min.css" rel="stylesheet">
@stop
@section('content')
@section('page-title', 'تنظیمات پروفایل')
@section('page-name', 'پروفایل')
@section('page-desc', 'تنظیمات پروفایل')
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="m-b-20">
                        <div class="contact-grid">
                            <div class="profile-header bg-dark">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="name-center">
                                    {{ auth()->user()->role == 'admin' ? 'مدیریت سایت' : 'کاربر عادی' }}
                                </div>
                            </div>
                            <img id="uploaded_image"
                                 src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}"
                                 width="112" height="112" class="user-img" alt="">
                            <div class="alert" id="message" style="display: none"></div>
                            <form method="post" id="upload_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <td width="40%" align="right"><label>تغییر تصویر</label></td>
                                            <td width="30"><input type="file" name="select_file" id="select_file"/>
                                            </td>
                                            <td width="30%" align="left"><input type="submit" name="upload"
                                                                                id="upload" class="btn btn-success"
                                                                                value="بارگذاری"></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <br/>
                            <p>تاریخ عضویت : {{ Verta::instance(auth()->user()->created_at)->format('%d %B %Y') }}</p>
                            <div class="row">
                                <div class="col-4">
                                    <h5>{{ $PodcastCount }}</h5>
                                    <small>پادکست ها</small>
                                </div>
                                <div class="col-4">
                                    <h5>{{ $AlbumCount }}</h5>
                                    <small>آلبوم ها</small>
                                </div>
                                <div class="col-4">
                                    <h5>{{ $diskSize }}</h5>
                                    <small>فضای استفاده شده</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>درباره من</h2>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane body active" id="about">
                            <p class="text-default">{{ auth()->user()->about }}</p>
                            <small class="text-muted">آدرس ایمیل: </small>
                            <p>{{ auth()->user()->email }}</p>
                            <hr>
                            <small class="text-muted">تلفن: </small>
                            <p>{{ auth()->user()->mobile }}</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="project" aria-expanded="true">
                        <div class="card">
                            <div class="header">
                                <h2>ویرایش اطلاعات کاربری</h2>
                            </div>
                            <div class="body">
                                @if ($message = Session::get('done'))
                                    <div id="msg-alert" class="alert alert-success alert-block">
                                        <button style="float: left" type="button" class="close" data-dismiss="alert">×
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif

                                @if ($message = Session::get('notdone'))
                                    <div id="msg-alert" class="alert alert-danger alert-block">
                                        <button style="float: left" type="button" class="close" data-dismiss="alert">×
                                        </button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <form action="{{ route('profile.update', auth()->user()->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="wrap-input100 validate-input"
                                                 data-validate="نام اصلی مورد نیاز است">
                                                @php $exp = explode(' ', auth()->user()->name) @endphp
                                                <input id="first_name" type="text" name="first_name"
                                                       class="input100 form-control @error('first_name') is-invalid @enderror"
                                                       required placeholder="نام اصلی"
                                                       oninvalid="this.setCustomValidity('نام اصلی خود را وارد کنید')"
                                                       oninput="setCustomValidity('')" value="{{ $exp[0] }}">
                                                <span class="focus-input100"></span>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="wrap-input100 validate-input"
                                                 data-validate="نام خانوادگی مورد نیاز است">
                                                <input id="last_name" type="text" name="last_name"
                                                       class="input100 form-control @error('last_name') is-invalid @enderror"
                                                       required placeholder="نام خانوادگی"
                                                       oninvalid="this.setCustomValidity('نام خانوادگی خود را وارد کنید')"
                                                       oninput="setCustomValidity('')" value="{{ $exp[1] }}">
                                                <span class="focus-input100"></span>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <div class="wrap-input100">
                                                    <input id="country" type="text" name="country"
                                                           class="input100 form-control @error('country') is-invalid @enderror"
                                                           placeholder="کشور"
                                                           value="{{ auth()->user()->country }}">
                                                    <span class="focus-input100"></span>
                                                    @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <div class="wrap-input100">
                                                    <input id="state" type="text" name="state"
                                                           class="input100 form-control @error('state') is-invalid @enderror"
                                                           placeholder="استان"
                                                           value="{{ auth()->user()->state }}">
                                                    <span class="focus-input100"></span>
                                                    @error('state')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <div class="wrap-input100">
                                                    <input id="city" type="text" name="city"
                                                           class="input100 form-control @error('city') is-invalid @enderror"
                                                           placeholder="شهر"
                                                           value="{{ auth()->user()->city }}">
                                                    <span class="focus-input100"></span>
                                                    @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="wrap-input100">
                                            <textarea id="about" name="about" rows="4"
                                                      class="input100 form-control @error('about') is-invalid @enderror"
                                                      placeholder="یک توضیح درباره خود وارد کنید">{{ auth()->user()->about }}</textarea>
                                                    <span class="focus-input100"></span>
                                                    @error('about')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-round">ذخیره تغییرات</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            @if ($message = Session::get('success'))
                                <div id="msg-alert" class="alert alert-success alert-block">
                                    <button style="float: left" type="button" class="close" data-dismiss="alert">×
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div id="msg-alert" class="alert alert-danger alert-block">
                                    <button style="float: left" type="button" class="close" data-dismiss="alert">×
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="header">
                                <h2>ویرایش رمز عبور</h2>
                            </div>
                            <div class="body">
                                <form action="{{ route('profile.update', auth()->user()->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="wrap-input100 validate-input"
                                         data-validate="رمز عبور فعلی مورد نیاز است">
                                        <input type="password" class="input100 form-control"
                                               name="old_password" required placeholder="رمز عبور فعلی"
                                               oninvalid="this.setCustomValidity('رمز عبور فعلی خود را وارد کنید')"
                                               oninput="setCustomValidity('')">
                                    </div>

                                    <div class="wrap-input100 validate-input"
                                         data-validate="رمز عبور جدید مورد نیاز است">
                                        <input id="new_password" type="password"
                                               class="input100 form-control @error('new_password') is-invalid @enderror"
                                               name="new_password" required placeholder="رمز عبور جدید"
                                               oninvalid="this.setCustomValidity('رمز عبور جدید خود را وارد کنید')"
                                               oninput="setCustomValidity('')">
                                        <span class="focus-input100"></span>
                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-info btn-round">ذخیره تغییرات</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $('#upload_form').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('ajaxupload.action', ['id' => auth()->user()->id]) }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').attr("src", data.uploaded_image);
                    }
                })
            });

        });
    </script>
@endsection
