<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"  wire:navigate>{{ Lang::get('Home', [], $locale) }}</a>
                <span></span> {{ Lang::get('messages.wishlist', [], $locale) }}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>
                                {{ str_replace(':count', {{ Cart::instance('wishlist')->count() }}, Lang::get('messages.found_products', [], $locale)) }}
                            </p>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @forelse (Cart::instance('wishlist')->content() as $product)

                            <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('details', ['slug' => $product->model->slug]) }}"  wire:navigate>
                                                <img class="default-img" src="{{ 'admin/products/'.$product->model->image }}" alt="">
                                                <img class="hover-img" src="{{ 'admin/products/'.$product->model->image }}" alt="">
                                            </a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop.html">Music</a>
                                        </div>
                                        <h2><a href="product-details.html">{{ $product->model->name }}</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            @php
                                                $adjustedPrice = $this->getAdjustedPrice($product->model);
                                            @endphp
                                            <span>${{ ${{ number_format($adjustedPrice, 2) }} }} </span>
                                            <span class="old-price">${{ $product->model->regular_price }}</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Rétirer aux favoris" class="action-btn hover-up" wire:click.prevent="deleteToWishlist({{$product->id}})">
                                                <i class="fi-rs-heart"></i></a>
                                            <a aria-label="Ajouter au panier" class="action-btn hover-up" wire:click.prevent="addToCart('{{$product->model->id}}','{{ addslashes($product->model->name) }}', 1, {{ $product->model->sale_price }})"><i class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty

                            <h5>Aucun produit trouvé</h5>

                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
