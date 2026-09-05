<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="/img/footer-bg.jpg">
    <div class="container">
        <div class="footer__subscriber">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer__subscriber__text">
                        <h3>عضویت رایگان در خبرنامه!</h3>
                        <p>جهت دریافت جدیدترین پادکست ها مشترک خبرنامه ما شوید.</p>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2">
                    @if ($message = Session::get('success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @else
                        <form action="{{ route('subscribe') }}" class="footer__subscriber__form wrap-input100 validate-input">
                            <input id="email" type="email" class="input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                                   placeholder="آدرس ایمیل خود را وارد کنید"
                                   oninvalid="this.setCustomValidity('ایمیل خود را وارد کنید')"
                                   oninput="setCustomValidity('')">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong style="background-color: #cbcbcb;padding: 1px;border-radius: 5px;">{{ $message }}</strong>
                                    </span>
                            @enderror
                            <span class="focus-input100"></span>
                            <button type="submit" class="site-btn">عضویت</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="footer__widget">
                    <div class="footer__logo d-flex align-items-center">
                        @include('layouts.partials.logo', ['size' => 40, 'fontSize' => '1rem'])
                    </div>
                    <p class="footer__copyright__text">© WaveCast {{ now()->format('Y') }} - تمامی حقوق محفوظ است.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="footer__social">
                    <a href="#" aria-label="فیسبوک"><i class="fa fa-facebook"></i></a>
                    <a href="#" aria-label="توییتر"><i class="fa fa-twitter"></i></a>
                    <a href="#" aria-label="پینترست"><i class="fa fa-pinterest"></i></a>
                    <a href="#" aria-label="اینستاگرام"><i class="fa fa-instagram"></i></a>
                    <a href="#" aria-label="یوتیوب"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/mixitup.min.js"></script>
<script src="/js/jquery.slicknav.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/main.js"></script>

<!-- Music Plugin -->
<script src="/js/jquery.jplayer.min.js"></script>
<script src="/js/jplayerInit.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
@yield('script')
</body>
</html>
