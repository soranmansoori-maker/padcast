@extends('layouts.app')
@section('title', 'ایجاد حساب کاربری')
@section('style')
    <style>
        .wrap-input100.has-error { height: auto; min-height: 60px; padding-bottom: 22px; margin-bottom: 18px; }
    </style>
@stop
@section('content')
    <div class="limiter rtl">
        <div class="container-login100" style="background-color: #fcaf17 !important;">
            <div class="wrap-login100">
                <form style="width: 450px !important;" method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-45">
						{{ __('auth.Register') }}
					</span>

                    <div class="wrap-input100 validate-input @error('name') has-error @enderror" data-validate="نام و نام خانوادگی مورد نیاز است">
                        <input id="name" type="text" class="input100 form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                               oninvalid="this.setCustomValidity('نام کامل خود را وارد کنید')"
                               oninput="setCustomValidity('')">

                        <span class="focus-input100"></span>
                        <label for="name" class="label-input100">{{ __('auth.Name') }}</label>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input @error('email') has-error @enderror" data-validate="آدرس ایمیل معتبر وارد کنید">
                        <input id="email" type="email"
                               class="input100 form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email"
                               oninvalid="this.setCustomValidity('پست الکترونیک خود را وارد کنید')"
                               oninput="setCustomValidity('')">
                        <span class="focus-input100"></span>
                        <label for="email" class="label-input100">{{ __('auth.E-Mail Address') }}</label>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input @error('mobile') has-error @enderror" data-validate="یک شماره تماس معتبر وارد کنید">
                        <input id="mobile" type="text"
                               class="input100 form-control @error('mobile') is-invalid @enderror" name="mobile"
                               value="{{ old('mobile') }}" autocomplete="mobile">
                        <span class="focus-input100"></span>
                        <label for="mobile" class="label-input100">{{ __('auth.Mobile Number') }}</label>

                        @error('mobile')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="wrap-input100 validate-input @error('password') has-error @enderror" data-validate="رمز عبور مورد نیاز است">
                        <input id="password" type="password"
                               class="input100 form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="new-password"
                               oninvalid="this.setCustomValidity('رمز عبور را وارد کنید')"
                               oninput="setCustomValidity('')">
                        <span class="focus-input100"></span>
                        <label for="password" class="label-input100">{{ __('auth.Password') }}</label>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="تکرار رمز عبور مورد نیاز است">
                        <input id="password-confirm" type="password" class="input100 form-control"
                               name="password_confirmation" required autocomplete="new-password"
                               oninvalid="this.setCustomValidity('تکرار رمز عبور را وارد کنید')"
                               oninput="setCustomValidity('')">
                        <span class="focus-input100"></span>
                        <label for="password-confirm" class="label-input100">{{ __('auth.Confirm Password') }}</label>
                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('auth.Register Btn') }}
                        </button>
                    </div>

                    <div class="text-center p-t-45 p-b-20">
						<span class="txt2">
                            قبلا ثبت نام کرده اید؟
							<a href="{{ route('login') }}" class="txt1">
                                وارد شوید
                            </a>
						</span>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('/img/breadcrumb-bg.jpg');">
                </div>
            </div>
        </div>
    </div>
@endsection
