<div>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <form method="POST" action="{{ route('set-locale') }}">
                                    @csrf
                                    <select name="locale" onchange="this.form.submit()">
                                        <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}><i class="fi-rs-world"></i>English</option>
                                        <option value="fr" {{ session('locale') === 'fr' ? 'selected' : '' }}><i class="fi-rs-world"></i>Français</option>
                                    </select>
                                </form>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>
                                        {{ Lang::get('messages.great_devices_off', [], $locale) }}
                                        <a href="{{ route('shop') }}">{{ Lang::get('messages.view_details', [], $locale) }}</a>
                                    </li>
                                    <li>{{ Lang::get('messages.value_deals_coupons', [], $locale) }}</li>
                                    <li>
                                        {{ Lang::get('messages.trendy_jewelry_off', [], $locale) }}
                                        <a href="{{ route('shop') }}">{{ Lang::get('messages.shop_now', [], $locale) }}</a>
                                    </li>
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
                                            @if (Auth::user()->usertype == 'admin')
                                                <i class="fi-rs-key"></i>
                                                <a href="{{ route('admin.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a>
                                            @else
                                                <i class="fi-rs-key"></i>
                                                <a href="{{ route('client.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a>
                                            @endif
                                            <i class="fi-rs-user"></i> {{ Auth::user()->name }}
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <i class="fi-rs-power"></i>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                    {{ Lang::get('messages.logout', [], $locale) }}
                                                </a>
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <i class="fi-rs-key"></i>
                                            <a href="{{ route('login') }}" wire:navigate>{{ Lang::get('messages.login', [], $locale) }}</a>

                                            @if (Route::has('register'))
                                                / <a href="{{ route('register') }}" wire:navigate>{{ Lang::get('messages.register', [], $locale) }}</a>
                                            @endif
                                        </li>
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
                                <span class="fi-rs-apps"></span> {{ Lang::get('messages.our_categories', [], $locale) }}
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                    <livewire:menu-categories />
                                </ul>
                                <div class="more_categories">{{ Lang::get('messages.show_more', [], $locale) }}</div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="{{ route('home') }}" wire:navigate>{{ Lang::get('messages.home', [], $locale) }}</a></li>
                                    <li><a href="{{ route('about') }}" wire:navigate>{{ Lang::get('messages.about', [], $locale) }}</a></li>
                                    <li><a href="{{ route('shop') }}" wire:navigate>{{ Lang::get('messages.shop', [], $locale) }}</a></li>
                                    <li><a href="{{ route('contact') }}" wire:navigate>{{ Lang::get('messages.contact', [], $locale) }}</a></li>
                                    <li>
                                        <a href="#">{{ Lang::get('messages.my_account', [], $locale) }}<i class="fi-rs-angle-down"></i></a>
                                        @auth()
                                            @if (Auth::user()->usertype == 'admin')
                                                <ul class="sub-menu">
                                                    <li><a href="{{ route('admin.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a></li>
                                                    <!-- Authentication -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <li>
                                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                {{ Lang::get('messages.logout', [], $locale) }}
                                                            </a>
                                                        </li>
                                                    </form>
                                                </ul>
                                            @else
                                                <ul class="sub-menu">
                                                    <li><a href="{{ route('client.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a></li>
                                                    <!-- Authentication -->
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <li>
                                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                                {{ Lang::get('messages.logout', [], $locale) }}
                                                            </a>
                                                        </li>
                                                    </form>
                                                </ul>
                                            @endif
                                        @else
                                            <ul class="sub-menu">
                                                <li><a href="{{ route('login') }}" wire:navigate>{{ Lang::get('messages.login', [], $locale) }}</a></li>
                                                <li><a href="{{ route('register') }}" wire:navigate>{{ Lang::get('messages.register', [], $locale) }}</a></li>
                                            </ul>
                                        @endauth
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>{{ Lang::get('messages.toll_free', [], $locale) }}</span> (+1) 0000-000-000 </p>
                    </div>
                    <p class="mobile-promotion">{!! Lang::get('messages.promotion_message', [], $locale) !!}</p>
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
                <ul>
                    <form method="POST" action="{{ route('set-locale') }}">
                        @csrf
                        <select name="locale" onchange="this.form.submit()">
                            <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}><i class="fi-rs-world"></i>English</option>
                            <option value="fr" {{ session('locale') === 'fr' ? 'selected' : '' }}><i class="fi-rs-world"></i>Français</option>
                        </select>
                    </form>
                </ul>
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
                            <span class="fi-rs-apps"></span> {{ Lang::get('messages.our_categories', [], $locale) }}
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
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('home') }}">{{ Lang::get('messages.home', [], $locale) }}</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop') }}">{{ Lang::get('messages.shop', [], $locale) }}</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop') }}">{{ Lang::get('messages.about', [], $locale) }}</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('contact') }}">{{ Lang::get('messages.contact', [], $locale) }}</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="{{ route('contact') }}" wire:navigate>
                            {{ Lang::get('messages.our_address', [], $locale) }}
                        </a>
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <div class="single-mobile-header-info">
                                    @if (Auth::user()->usertype == 'admin')
                                        <a href="{{ route('admin.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a>
                                    @else
                                        <a href="{{ route('client.dashboard') }}" wire:navigate>{{ Lang::get('messages.dashboard', [], $locale) }}</a>
                                    @endif
                                    <i class="fi-rs-user"></i> {{ Auth::user()->name }}
                                </div>

                                <div class="single-mobile-header-info">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="route('logout')"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">{{ Lang::get('messages.logout', [], $locale) }}</a>

                                    </form>
                                </div>

                                @else

                                <div class="single-mobile-header-info">
                                    <a href="{{ route('login') }}" wire:navigate>{{ Lang::get('messages.login', [], $locale) }}</a>
                                </div>
                                <div class="single-mobile-header-info">
                                    <a href="{{ route('register') }}" wire:navigate>{{ Lang::get('messages.register', [], $locale) }}</a>
                                </div>

                            @endauth
                        </nav>
                     @endif

                    <div class="single-mobile-header-info">
                        <a href="#">(+1) 0000-000-000 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">{{ Lang::get('messages.follow_us', [], $locale) }}</h5>
                    <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                    <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                    <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                    <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                    <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>

</div>
