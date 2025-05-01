<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow"  wire:navigate>{{ Lang::get('Home', [], $locale) }}</a>
                    <span></span> {{ Lang::get('messages.shop', [], $locale) }}
                    <span></span> {{ $category->name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>
                                    {{ str_replace(':count', $products->total(), Lang::get('messages.found_products', [], $locale)) }}
                                </p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>{{ Lang::get('messages.view', [], $locale) }}</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $productPerPage }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $productPerPage == 12 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(12)'>12</a></li>
                                            <li><a class="{{ $productPerPage == 24 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(24)'>24</a></li>
                                            <li><a class="{{ $productPerPage == 36 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(36)'>36</a></li>
                                            <li><a class="{{ $productPerPage == 48 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(48)'>48</a></li>
                                            <li><a class="{{ $productPerPage == 60 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(60)'>60</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span>
                                                <i class="fi-rs-apps-sort"></i>{{ Lang::get('messages.sort_by', [], $locale) }}
                                            </span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $shortProductBy }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li>
                                                <a class="{{ $shortProductBy == 'Defaut' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Defaut')">
                                                    {{ Lang::get('messages.default', [], $locale) }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ $shortProductBy == 'Bas a Haut' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Bas a Haut')">
                                                    {{ Lang::get('messages.price_low_to_high', [], $locale) }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ $shortProductBy == 'Haut en Bas' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Haut en Bas')">
                                                    {{ Lang::get('messages.price_high_to_low', [], $locale) }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ $shortProductBy == 'Nouveaux Produits' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Nouveaux Produits')">
                                                    {{ Lang::get('messages.new_products', [], $locale) }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @forelse ($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6 g-2">
                                    <div class="product-cart-wrap mb-10">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('details', ['slug' => $product->slug]) }}" wire:navigate>
                                                    <img class="default-img" src="{{ asset('admin/products/' . $product->image) }}" alt="">
                                                    <img class="hover-img" src="{{ asset('admin/products/' . $product->image) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('product.category', ['slug' => $product->category->slug]) }}" wire:navigate>
                                                    {{ $product->category->name }}
                                                </a>
                                            </div>
                                            <h2>
                                                <a href="{{ route('details', ['slug' => $product->slug]) }}" wire:navigate>
                                                    {{ $product->name }}
                                                </a>
                                            </h2>
                                            <div class="product-price">
                                                @php
                                                    $adjustedPrice = $this->getAdjustedPrice($product);
                                                @endphp
                                                <span>${{ number_format($adjustedPrice, 2) }}</span>
                                                <span class="old-price">${{ number_format($product->regular_price, 2) }}</span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <button type="button" class="action-btn hover-up" wire:click="addToCart('{{ $product->id }}', '{{ addslashes($product->name) }}', 1, {{ $adjustedPrice }})" aria-label="Ajouter au panier">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5>{{ __('messages.no_products_found') }}</h5>
                            @endforelse
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30" wire:ignore>
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">
                                {{ Lang::get('messages.categories', [], $locale) }}
                            </h5>
                            <ul class="categories">

                                @foreach ($categories as $category)
                                    <li><a href='{{ route('product.category', ['slug' => $category->slug]) }}' wire:navigate>{{ $category->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10" wire:ignore>
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Nouveaux Produits</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @forelse ($newProducts as $newProduct)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ asset('admin/products/'.$newProduct->image) }}" alt="#">
                                    </div>
                                    <div class="content pt-10">
                                        <h5><a href="{{ route('details', ['slug' => $newProduct->slug]) }}" wire:navigate>{{ $newProduct->name }}</a></h5>
                                        <p class="price mb-0 mt-5">${{ $newProduct->regular_price }}</p>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:90%"></div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none" wire:ignore>
                            <img src="{{ asset('admin/products/'.$newProduct->image) }}" alt="">
                            <div class="banner-text">
                                <span>{{ $newProduct->category->name }}</span>
                                <h4>{{ $newProduct->name }}</h4>
                                <a href="shop.html">{{ Lang::get('messages.slider_button', [], $locale) }}
                                    <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 1000,
                values: [200, 800],
                slide: function(event, ui) {
                    amountprice.val(@this.set('min_price', ui.values[0]) + " - " + @this.set('max_price', ui.values[1]));

                }
            });
        });
    </script>
@endpush
