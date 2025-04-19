<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow"  wire:navigate>Accueil</a>
                    <span></span> Boutique
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> Nous trouvons <strong class="text-brand">{{ $products->total() }}</strong> produits pour vous!</p>
                            </div>
                            <div class="sort-by-product-area">
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
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @forelse ($products as $product)

                                <div class="col-lg-4 col-md-4 col-6 col-sm-6 g-2">
                                    <div class="product-cart-wrap mb-10">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('details', ['slug' => $product->slug]) }}"  wire:navigate>
                                                    <img class="default-img" src="{{ $product->image }}" alt="">
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
                                            <h2><a href="{{ route('details', ['slug' => $product->slug]) }}"  wire:navigate>{{ $product->name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>${{ $product->sale_price }} </span>
                                                <span class="old-price">${{ $product->regular_price }}</span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <button type="button" class="action-btn hover-up" wire:click="addToCart('{{$product->id}}','{{ addslashes($product->name) }}', 1, {{ $product->sale_price }})" aria-label="Ajouter au panier">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty

                                <h5>Aucun produit trouvé</h5>

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
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Catégories</h5>
                            <ul class="categories">

                                @foreach ($categories as $category)
                                    <li><a href='{{ route('product.category', ['slug' => $category->slug]) }}' wire:navigate>{{ $category->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Remplir par prix</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner" >
                                    <div id="slider-range" wire:ignore></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Rang:</span><span>${{ $min_price }}</span> - <span>${{ $max_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">Color</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                        <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                    </div>
                                    <label class="fw-900 mt-15">Item Condition</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                        <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                        <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                    </div>
                                </div>
                            </div>
                            <a href="shop.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Nouveux Produits</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @forelse ($newProducts as $newProduct)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ $newProduct->image }}" alt="#">
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
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="assets/imgs/banner/banner-11.jpg" alt="">
                            <div class="banner-text">
                                <span>Women Zone</span>
                                <h4>Save 17% on <br>Office Dress</h4>
                                <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
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
