<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow"  wire:navigate>{{ Lang::get('Home', [], $locale) }}</a>
                <span></span> {{ Lang::get('messages.shop', [], $locale) }}
                    <span></span> {{ $product->name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery" wire:ignore>
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @forelse ($productImages as $key => $productImage)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('admin/products/'.$productImage) }}" alt="product image">
                                                </figure>
                                            @empty

                                            @endforelse
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">

                                            @forelse ($productImages as $key => $productImage)
                                                <div><img src="{{ asset('admin/products/'.$productImage) }}" alt="product image"></div>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                    <div class="social-icons single-share">
                                        <ul class="text-grey-5 d-inline-block">
                                            <li><strong class="mr-10">Partagez ceci:</strong></li>
                                            <li class="social-facebook"><a href="#"><img src="{{ asset('imgs/theme/icons/icon-facebook.svg') }}" alt=""></a></li>
                                            <li class="social-twitter"> <a href="#"><img src="{{ asset('imgs/theme/icons/icon-twitter.svg') }}" alt=""></a></li>
                                            <li class="social-instagram"><a href="#"><img src="{{ asset('imgs/theme/icons/icon-instagram.svg') }}" alt=""></a></li>
                                            <li class="social-linkedin"><a href="#"><img src="{{ asset('imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @php
                                                    $adjustedPrice = $this->getAdjustedPrice($product);
                                                @endphp

                                                <ins><span class="text-brand">${{ number_format($adjustedPrice, 2) }}</span></ins>
                                                <ins><span class="old-price font-md ml-15">${{ $product->regular_price }}</span></ins>
                                                @php
                                                    $reduction = $product->regular_price - $adjustedPrice;

                                                    if ($reduction > 0) {
                                                        $pourcent = ($reduction / $product->regular_price) * 100;
                                                    }else{
                                                        $pourcent = 0;
                                                    }

                                                @endphp
                                                <span class="save-price  font-md color3 ml-15">{{ number_format($pourcent, 0) }}% de Réduction</span>
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{{ $product->short_description }}</p>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            <div class="detail-qty border radius">
                                                <a class="qty-down" wire:click='decrement'><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{ $quantityProduct }}</span>
                                                <a class="qty-up" wire:click='increment({{ $product->quantity }})'><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                <button type="button" class="button button-add-to-cart"
                                                    wire:click.prevent="addToCart('{{$product->id}}','{{ addslashes($product->name) }}', {{ $adjustedPrice }})"
                                                    {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                                    {{ $product->quantity == 0
                                                    ? Lang::get('messages.out_of_stock', [], $locale)
                                                    : Lang::get('messages.add_to_cart', [], $locale) }}</button>

                                                @php
                                                    $item = Cart::instance('wishlist')->content()->pluck('id');
                                                @endphp
                                                @if ($item->contains($product->id))

                                                    <a aria-label="{{ Lang::get('messages.remove_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="deleteToWishlist({{$product->id}})">
                                                        <i class="fi-rs-heart"></i></a>

                                                    @else

                                                        <a aria-label="{{ Lang::get('messages.add_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="addToWishlist('{{$product->id}}','{{ addslashes($product->name) }}', {{ $adjustedPrice }})">
                                                            <i class="fi-rs-heart"></i></a>
                                                @endif

                                            </div>
                                        </div>
                                        <ul class="product-meta font-xs color-grey mt-50">

                                            <li>
                                                {{ Lang::get('messages.available', [], $locale) }}:
                                                <span class="in-stock text-success ml-5">
                                                    {{ Lang::get('messages.products_in_stock', ['count' => $product->quantity], $locale) }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>{{ $product->long_description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">{{ Lang::get('messages.similar_products', [], $locale) }}</h3>                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @forelse ($relatedProducts as $relatedProduct)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap small hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{ route('details', ['slug' => $relatedProduct->slug]) }}" wire:navigate tabindex="0">
                                                                <img class="default-img" src="{{ asset('admin/products/'.$relatedProduct->image) }}" alt="">
                                                                <img class="hover-img" src="{{ asset('admin/products/'.$relatedProduct->image) }}" alt="">
                                                            </a>
                                                        </div>
                                                        {{-- <div class="product-action-1">
                                                            <a aria-label="{{ Lang::get('messages.quick_view', [], $locale) }}" wire:click.prevent='showProductQuickViewModal({{ $relatedProduct->id }})' class="action-btn small hover-up" wire:navigate><i class="fi-rs-search"></i></a>
                                                            @php
                                                                $item = Cart::instance('wishlist')->content()->pluck('id');
                                                            @endphp
                                                            @if ($item->contains($relatedProduct->id))

                                                                <a aria-label="{{ Lang::get('messages.remove_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="deleteToWishlist({{ $relatedProduct->id }})">
                                                                    <i class="fi-rs-heart"></i></a>
                                                                @else

                                                                    <a aria-label="{{ Lang::get('messages.add_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="addToWishlist('{{ $relatedProduct->id }}','{{ addslashes($relatedProduct->name) }}', {{ $relatedProduct->sale_price }})">
                                                                        <i class="fi-rs-heart"></i></a>
                                                            @endif
                                                        </div> --}}
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Hot</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <h2><a href="{{ route('details', ['slug' => $relatedProduct->slug]) }}" tabindex="0" wire:navigate>{{ $relatedProduct->name }}</a></h2>
                                                        <div class="rating-result" title="90%">
                                                            <span>
                                                            </span>
                                                        </div>
                                                        <div class="product-price">
                                                            @php
                                                                $adjustedPrice = $this->getAdjustedPrice($relatedProduct);
                                                            @endphp

                                                            <span>${{ number_format($adjustedPrice, 2) }}</span>
                                                            <span class="old-price">${{ $relatedProduct->regular_price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty

                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">{{ Lang::get('messages.categories', [], $locale) }}</h5>

                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a href='{{ route('product.category', ['slug' => $category->slug]) }}' wire:navigate>{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">{{ Lang::get('messages.new_products', [], $locale) }}</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @forelse ($newProducts as $newProduct)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ asset('admin/products/'.$newProduct->image) }}" alt="#">
                                    </div>
                                    <div class="content pt-10">
                                        <h5><a href="{{ route('details', ['slug' => $newProduct->slug]) }}">{{ $newProduct->name }}</a></h5>
                                        @php
                                            $adjustedPrice = $this->getAdjustedPrice($relatedProduct);
                                        @endphp
                                        <p class="price mb-0 mt-5">${{ number_format($adjustedPrice, 2) }}</p>

                                        <div class="product-rate">
                                            <div class="product-rating" style="width:90%"></div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick view -->
    {{-- <div class="modal fade custom-modal" wire:ignore.self id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" wire:click.prevent='resentQuantity' data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('/'.$productImagesView) }}" alt="product image">
                                    </figure>
                                </div>
                            </div>
                            <!-- End Gallery -->
                            <div class="social-icons single-share">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Share this:</strong></li>
                                    <li class="social-facebook"><a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                    <li class="social-twitter"> <a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                    <li class="social-instagram"><a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                    <li class="social-linkedin"><a href="#"><img src="{{ asset('/') }}assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h3 class="title-detail mt-30">{{ $productName }}</h3>
                                <div class="product-detail-rating">
                                    <div class="pro-details-brand">
                                        <span> Brands: <a href="shop.html">Bootstrap</a></span>
                                    </div>
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <ins><span class="text-brand">${{ $productSalePrice }}</span></ins>
                                        <ins><span class="old-price font-md ml-15">${{ $productRegularPrice }}</span></ins>
                                        @php
                                            $reduction = $productRegularPrice - $productSalePrice;

                                            if ($reduction > 0) {
                                                $pourcent = ($reduction / $productRegularPrice) * 100;
                                            }else{
                                                $pourcent = 0;
                                            }

                                        @endphp
                                        <span class="save-price  font-md color3 ml-15">{{ number_format($pourcent, 0) }}% de Réduction</span>
                                    </div>
                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="short-desc mb-30">
                                    <p class="font-sm">{{ $productShortDescription }}</p>
                                </div>
                                <br>
                                <div class="detail-extralink">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down" wire:click='decrement'><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">{{ $quantityProduct }}</span>
                                        <a href="#" class="qty-up" wire:click='increment({{ $productQuantity }})'><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit"
                                                class="button button-add-to-cart"
                                                wire:click.prevent="addToCartQuickView('{{ $productId }}','{{ addslashes($productName) }}', {{ $productSalePrice }})"
                                                {{ $productQuantity == 0 ? 'disabled' : '' }}>
                                            {{ $productQuantity == 0
                                                ? Lang::get('messages.out_of_stock', [], $locale)
                                                : Lang::get('messages.add_to_cart', [], $locale) }}
                                        </button>

                                        @php
                                            $item = Cart::instance('wishlist')->content()->pluck('id');
                                        @endphp
                                        @if ($item->contains($productId))

                                            <a aria-label="{{ Lang::get('messages.remove_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="deleteToWishlist({{$productId}})">
                                                <i class="fi-rs-heart"></i></a>

                                            @else

                                                <a aria-label="{{ Lang::get('messages.add_from_favorites', [], $locale) }}" class="action-btn hover-up" wire:click.prevent="addToWishlist('{{$productId}}','{{ addslashes($productName) }}', {{ $productSalePrice }})">
                                                    <i class="fi-rs-heart"></i></a>
                                        @endif

                                    </div>
                                </div>
                                <ul class="product-meta font-xs color-grey mt-20">
                                    <span class="mb-5">SKU: <a href="#">FWM15VKT</a></span>
                                    <span class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </span>
                                    <span>Disponible:<span class="in-stock text-success ml-5">{{ $productQuantity }} Produits en Stock</span></span>
                                </ul>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    </main>

    <script>
        window.addEventListener('showProductQuickViewModal', event => {
           // Écoutez l'événement personnalisé 'openModal'
           $('#quickViewModal').modal('show'); // Affiche la modale
       });
         window.addEventListener('hideQuickViewModal', event => {
            // Écoutez l'événement personnalisé 'openModal'
            $('#quickViewModal').modal('hide'); // Affiche la modale
        });

    </script>
</div>
