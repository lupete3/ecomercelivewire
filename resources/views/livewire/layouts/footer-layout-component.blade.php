<div>
    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email" src="assets/imgs/theme/icons/icon-email.svg" alt="">
                                <h4 class="font-size-20 mb-0 ml-3">{{ Lang::get('messages.subscribe_newsletter', [], $locale) }}</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">{!! Lang::get('messages.receive_coupon', [], $locale) !!}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small" placeholder="{{ Lang::get('messages.email', [], $locale) }}">
                            <button class="btn bg-dark text-white" type="submit">{{ Lang::get('messages.subscribe', [], $locale) }}</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="{{ route('home') }}"><img src="{{ asset('/') }}assets/imgs/logo/logo.png" alt="logo" wire:navigate></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">{{ Lang::get('messages.contact', [], $locale) }}</h5>
                            <p class="wow fadeIn animated">
                                <strong>{{ Lang::get('messages.address', [], $locale) }}</strong>562 Wellington Road
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>{{ Lang::get('messages.phone', [], $locale) }}</strong>+1 0000-000-000
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>{{ Lang::get('messages.email', [], $locale) }}</strong>contact@surfsidemedia.in
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">{{ Lang::get('messages.follow_us', [], $locale) }}</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">{{ Lang::get('messages.about', [], $locale) }}</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{ route('about') }}" wire:navigate>{{ Lang::get('messages.about', [], $locale) }}</a></li>
                            <li><a href="#">{{ Lang::get('messages.delivery_info', [], $locale) }}</a></li>
                            <li><a href="#">{{ Lang::get('messages.privacy_policy', [], $locale) }}</a></li>
                            <li><a href="#">{{ Lang::get('messages.terms_conditions', [], $locale) }}</a></li>
                            <li><a href="{{ route('contact') }}" wire:navigate>{{ Lang::get('messages.contact_us', [], $locale) }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">{{ Lang::get('messages.my_account', [], $locale) }}</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="my-account.html">{{ Lang::get('messages.my_account', [], $locale) }}</a></li>
                            <li><a href="#">{{ Lang::get('messages.view_cart', [], $locale) }}</a></li>
                            <li><a href="#">{{ Lang::get('messages.my_wishlist', [], $locale) }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">{{ Lang::get('messages.install_app', [], $locale) }}</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">{{ Lang::get('messages.from_app_store', [], $locale) }}</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="assets/imgs/theme/app-store.jpg" alt=""></a>
                                    <a href="#" class="hover-up"><img src="assets/imgs/theme/google-play.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">{{ Lang::get('messages.secured_payment', [], $locale) }}</p>
                                <img class="wow fadeIn animated" src="assets/imgs/theme/payment-method.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="privacy-policy.html">{{ Lang::get('messages.privacy_policy_link', [], $locale) }}</a> |
                        <a href="terms-conditions.html">{{ Lang::get('messages.terms_conditions_link', [], $locale) }}</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        {!! Lang::get('messages.all_rights_reserved', [], $locale) !!}
                    </p>
                </div>
            </div>
        </div>
    </footer>

</div>
