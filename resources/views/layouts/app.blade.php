<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>

        <meta charset="utf-8">
        <title>Surfside Media</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="">
        <meta property="og:type" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}assets/imgs/theme/favicon.ico">


        <link rel="stylesheet" href="{{ asset('/') }}assets/css/main.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/button.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/icheck/icheck-material.min.css">

        @livewireStyles



    </head>

    <body>
        <header class="header-area header-style-1 header-height-2">
            <div class="header-top header-top-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4">
                            <div class="header-info">
                            <ul>
                                    <li>
                                        <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> Français <i class="fi-rs-angle-small-down"></i></a>
                                        <ul class="language-dropdown">
                                            <li><a href="#"><img src="assets/imgs/theme/flag-fr.png" alt="">English</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4">
                            <div class="text-center">
                                <div id="news-flash" class="d-inline-block">
                                    <ul>
                                        <li>Get great devices up to 50% off <a href="shop.html">View details</a></li>
                                        <li>Supper Value Deals - Save more with coupons</li>
                                        <li>Trendy 25silver jewelry, save up 35% off today <a href="shop.html">Shop now</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="header-info header-info-right">
                                <ul>
                                    @if (Route::has('login'))
                                        <nav class="-mx-3 flex flex-1 justify-end">
                                            @auth

                                                <li>
                                                    <i class="fi-rs-key"></i><a href="{{ url('/dashboard') }}" wire:navigate>Tableau de bord </a>
                                                    <i class="fi-rs-user"></i> {{ Auth::user()->name }}
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <i class="fi-rs-power"></i><a href="route('logout')"
                                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">Se déconnecter</a>

                                                    </form>
                                                </li>

                                            @else

                                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}" wire:navigate>Se conneter </a>

                                                @if (Route::has('register'))

                                                    / <a href="{{ route('register') }}" wire:navigate>Créer un compte</a></li>

                                                @endif
                                            @endauth
                                        </nav>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                <div class="container">
                    <div class="header-wrap">
                        <div class="logo logo-width-1">
                            <a href="{{ route('home') }}"><img src="{{ asset('/') }}assets/imgs/logo/logo.png" alt="logo"></a>
                        </div>
                        <div class="header-right">

                            <div class="search-style-1">

                                @livewire('search-header-component')

                            </div>

                            <div class="header-action-right">

                                <div class="header-action-2">

                                    @livewire('wishlisticon-component')

                                    @livewire('carticon-component')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-bottom-bg-color sticky-bar">
                <div class="container">
                    <div class="header-wrap header-space-between position-relative">
                        <div class="logo logo-width-1 d-block d-lg-none">
                            <a href="{{ route('home') }}" wire:navigate><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                        </div>
                        <div class="header-nav d-none d-lg-flex">
                            <div class="main-categori-wrap d-none d-lg-block">
                                <a class="categori-button-active" href="#">
                                    <span class="fi-rs-apps"></span> Nos Catégories
                                </a>
                                <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                    <ul>
                                        <livewire:menu-categories />
                                    </ul>
                                    <div class="more_categories">Show more...</div>
                                </div>
                            </div>
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li><a class="active" href="{{ route('home') }}" wire:navigate>Accueil </a></li>
                                        <li><a href="{{ route('about') }}" wire:navigate>A propos</a></li>
                                        <li><a href="{{ route('shop') }}" wire:navigate>Boutique</a></li>
                                        <li><a href="{{ route('contact') }}" wire:navigate>Contact</a></li>
                                        <li><a href="#" wire:navigate>Mon compte<i class="fi-rs-angle-down"></i></a>
                                            @auth()

                                                @if (Auth::user()->usertype == 'admin')
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('admin.dashboard') }}" wire:navigate>Tableau de bord</a></li>
                                                        <li><a href="#">Produits</a></li>
                                                        <li><a href="#">Catégories</a></li>
                                                        <li><a href="#">Coupons</a></li>
                                                        <li><a href="#">Commandes</a></li>
                                                        <li><a href="#">Clients</a></li>
                                                        <!-- Authentication -->
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf

                                                            <li><a href="route('logout')"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">Se déconnecter</a>
                                                            </li>
                                                        </form>

                                                    </ul>
                                                @else
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('client.dashboard') }}" wire:navigate>Tableau de bord</a></li>
                                                        <li><a href="#">Commandes</a></li>

                                                        <!-- Authentication -->
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf

                                                            <li><a href="route('logout')"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">Se déconnecter</a>
                                                            </li>
                                                        </form>

                                                    </ul>
                                                @endif

                                            @else

                                            @endauth
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="hotline d-none d-lg-block">
                            <p><i class="fi-rs-smartphone"></i><span>Toll Free</span> (+1) 0000-000-000 </p>
                        </div>
                        <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>
                        <div class="header-action-right d-block d-lg-none">
                            <div class="header-action-2">
                                @livewire('wishlisticon-component')

                                @livewire('carticon-component')
                                
                                <div class="header-action-icon-2 d-block d-lg-none">
                                    <div class="burger-icon burger-icon-white">
                                        <span class="burger-icon-top"></span>
                                        <span class="burger-icon-mid"></span>
                                        <span class="burger-icon-bottom"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="mobile-header-wrapper-inner">
                <div class="mobile-header-top">
                    <div class="mobile-header-logo">
                        <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                        <button class="close-style search-close">
                            <i class="icon-top"></i>
                            <i class="icon-bottom"></i>
                        </button>
                    </div>
                </div>
                <div class="mobile-header-content-area">
                    <div class="mobile-search search-style-3 mobile-header-border">
                        @livewire('search-header-component')
                    </div>

                    <div class="mobile-menu-wrap mobile-header-border">
                        <div class="main-categori-wrap mobile-header-border">
                            <a class="categori-button-active-2" href="#">
                                <span class="fi-rs-apps"></span> Nos Categories
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-small">
                                <ul>

                                    <livewire:menu-categories />

                                </ul>
                            </div>
                        </div>
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('home') }}">Accueil</a></li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop') }}">Boutique</a></li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop') }}">Apropos</a></li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="mobile-header-info-wrap mobile-header-border">
                        <div class="single-mobile-header-info mt-30">
                            <a href="{{ route('contact') }}"> Notre Adresse </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('login') }}">Se connecter</a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('register') }}">S'inscrire</a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="#">(+1) 0000-000-000 </a>
                        </div>
                    </div>
                    <div class="mobile-social-icon">
                        <h5 class="mb-15 text-grey-4">Nous suivre</h5>
                        <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot }}

        <footer class="main">
            <section class="newsletter p-30 text-white wow fadeIn animated">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-md-3 mb-lg-0">
                            <div class="row align-items-center">
                                <div class="col flex-horizontal-center">
                                    <img class="icon-email" src="assets/imgs/theme/icons/icon-email.svg" alt="">
                                    <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                                </div>
                                <div class="col my-4 my-md-0 des">
                                    <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$25 coupon for first shopping.</strong></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <!-- Subscribe Form -->
                            <form class="form-subcriber d-flex wow fadeIn animated">
                                <input type="email" class="form-control bg-white font-small" placeholder="Enter your email">
                                <button class="btn bg-dark text-white" type="submit">Subscribe</button>
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
                                    <a href="{{ route('home') }}"><img src="{{ asset('/') }}assets/imgs/logo/logo.png" alt="logo"></a>
                                </div>
                                <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                                <p class="wow fadeIn animated">
                                    <strong>Address: </strong>562 Wellington Road
                                </p>
                                <p class="wow fadeIn animated">
                                    <strong>Phone: </strong>+1 0000-000-000
                                </p>
                                <p class="wow fadeIn animated">
                                    <strong>Email: </strong>contact@surfsidemedia.in
                                </p>
                                <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
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
                            <h5 class="widget-title wow fadeIn animated">About</h5>
                            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                <li><a href="{{ route('about') }}" wire:navigate>A propos</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="{{ route('contact') }}" wire:navigate>Nous contacter</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2  col-md-3">
                            <h5 class="widget-title wow fadeIn animated">My Account</h5>
                            <ul class="footer-list wow fadeIn animated">
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Order</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 mob-center">
                            <h5 class="widget-title wow fadeIn animated">Install App</h5>
                            <div class="row">
                                <div class="col-md-8 col-lg-12">
                                    <p class="wow fadeIn animated">From App Store or Google Play</p>
                                    <div class="download-app wow fadeIn animated mob-app">
                                        <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="assets/imgs/theme/app-store.jpg" alt=""></a>
                                        <a href="#" class="hover-up"><img src="assets/imgs/theme/google-play.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                    <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
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
                            <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-conditions.html">Terms & Conditions</a>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-lg-end text-start font-sm text-muted mb-0">
                            &copy; <strong class="text-brand">SurfsideMedia</strong> All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Vendor JS-->
        <script src="{{ asset('/') }}assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/slick.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.syotimer.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/wow.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery-ui.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/perfect-scrollbar.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/magnific-popup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/select2.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/waypoints.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/counterup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.countdown.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/images-loaded.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/isotope.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/scrollup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.vticker-min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.theia.sticky.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.elevatezoom.js"></script>
        <!-- Template  JS -->
        <script src="{{ asset('/') }}assets/js/main.js?v=3.3"></script>
        <script src="{{ asset('/') }}assets/js/shop.js?v=3.3"></script>

        <script src="{{ asset('/') }}assets/js/sweetalert2.all.min.js"></script>

        @livewireScripts

        <script>

            window.addEventListener('openAddShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#addShippingModal').modal('show'); // Affiche la modale
            });

            window.addEventListener('openEditShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#editShippingModal').modal('show'); // Affiche la modale
            });

            window.addEventListener('hideAddShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#addShippingModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('hideEditShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#editShippingModal').modal('hide'); // Affiche la modale
            });



            window.addEventListener('showAddSliderModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#addSliderModal').modal('show'); // Affiche la modale
            });

            window.addEventListener('openEditShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#editShippingModal').modal('show'); // Affiche la modale
            });

            window.addEventListener('hideAddSliderModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#addSliderModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('hideEditShippingModal', event => {
                // Écoutez l'événement personnalisé 'openModal'
                $('#editShippingModal').modal('hide'); // Affiche la modale
            });

            //Confim before delete shipping adress
            window.addEventListener('clientConfirm', (event) => {

                Swal.fire({

                    // icon: event.detail.type,
                    title: event.detail.title,
                    html: event.detail.message,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#33cc33',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Non',
                    confirmButtonText: 'Oui'

                })

                .then((result) => {

                    if (result.isConfirmed) {
                        Livewire.dispatch('clientConfirmAction', {id: event.detail.id});
                    } else {
                        Livewire.dispatch('makeActionCancel', {id: event.detail.id});
                    }
                });
            })

            //Confim before delete slider
            window.addEventListener('sliderConfirm', (event) => {

                Swal.fire({

                    // icon: event.detail.type,
                    title: event.detail.title,
                    html: event.detail.message,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#33cc33',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Non',
                    confirmButtonText: 'Oui'

                })

                .then((result) => {

                    if (result.isConfirmed) {
                        Livewire.dispatch('sliderConfirmAction', {id: event.detail.id});
                    } else {
                        Livewire.dispatch('makeActionCancel', {id: event.detail.id});
                    }
                });
            })



        </script>

        @stack('scripts')

    </body>

</html>
