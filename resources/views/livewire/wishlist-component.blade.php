<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow"  wire:navigate>Accueil</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> Nous trouvons <strong class="text-brand">{{ Cart::instance('wishlist')->count() }}</strong> produits pour vous!</p>
                            </div>
                            {{-- <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Voir:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $productPerPage }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $productPerPage == 12 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(0)'>12</a></li>
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
                                            <span><i class="fi-rs-apps-sort"></i>Tri par:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $shortProductBy }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $shortProductBy == 'Defaut' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Defaut')">Défaut</a></li>
                                            <li><a class="{{ $shortProductBy == 'Bas a Haut' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Bas a Haut')">Prix: Bas à Haut</a></li>
                                            <li><a class="{{ $shortProductBy == 'Haut en Bas' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Haut en Bas')">Prix: Haut en Bas</a></li>
                                            <li><a class="{{ $shortProductBy == 'Nouveaux Produits' ? 'active' : '' }}" wire:click.prevent="changeShortBy('Nouveaux Produits')">Nouveauté des produits</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row product-grid-3">
                            @forelse (Cart::instance('wishlist')->content() as $product)

                                <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('details', ['slug' => $product->model->slug]) }}"  wire:navigate>
                                                    <img class="default-img" src="{{ $product->model->image }}" alt="">
                                                    <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
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
                                                <span>${{ $product->model->sale_price }} </span>
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
</div>
