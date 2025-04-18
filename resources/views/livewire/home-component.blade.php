<div>
    <main class="main">
        <section class="home-slider position-relative pt-50" wire:ignore>
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @foreach ($sliders as $slider)

                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6">
                                    <div class="hero-slider-content-2">
                                        <h4 class="animated">{{ $slider->top_title }}</h4>
                                        <h2 class="animated fw-900">{{ $slider->title }}</h2>
                                        <h1 class="animated fw-900 text-brand">{{ $slider->sub_title }}</h1>
                                        <p class="animated">Economisez davantage avec le coupon jusqu'à {{ $slider->offer }}% de réduction</p>
                                        <a class="animated btn btn-brush btn-brush-3" href="{{ $slider->link }}">Allez-y maintenant</a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated slider-1-1" src="{{ $slider->getImage() }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding position-relative">

            <div class="container">
                <style>
                    .gra1 {
                        border: 1px solid #fff;
                        border-radius: 2px;
                        padding: 10px; /* Ajout de remplissage pour éviter les bords serrés */
                    }

                    .h3 {
                        font-size: 21px;
                        margin-bottom: 15px; /* Ajout d'espacement après le titre */
                    }

                    .homecontent {
                        transition: all .25s ease-in-out;
                        border: 1px solid #efe8e8;
                        margin: 5px;
                        display: inline-block;
                        font-size: 16px;
                        padding: 10px;
                        width: 160px;
                        height: 120px;
                        border-radius: 2px;
                        -webkit-box-shadow: rgba(99, 99, 99, .2) 0 2px 8px 0;
                        -moz-box-shadow: rgba(99, 99, 99, .2) 0 2px 8px 0;
                        box-shadow: rgba(99, 99, 99, .2) 0 2px 8px 0;
                        text-align: center;
                        position: relative; /* Ajout pour améliorer le positionnement */
                        overflow: hidden; /* Cache les débordements */
                    }

                    .homecontent img {
                        max-width: 100%;
                        height: auto; /* Suppression de la hauteur fixe */
                        object-fit: contain; /* Maintient les proportions */
                        object-position: center; /* Centre l'image */
                        margin: 0 auto; /* Centre horizontalement */
                        display: block; /* Convertit en élément block */
                        width: 100%; /* Pleine largeur */
                        max-height: 60px; /* Hauteur maximale pour garder un équilibre */
                    }

                    .homecontent p {
                        margin-top: 10px; /* Espacement entre image et texte */
                        padding: 0;
                        line-height: 1.4;
                        overflow: hidden;
                        text-overflow: ellipsis; /* Affiche ... si le texte est trop long */
                        height: 42px;
                        font-size: 14.5px;
                    }

                    .homecontent:hover {
                        box-shadow: rgba(99, 99, 99, .2) 0 2px 28px 0;
                    }
                </style>

                <fieldset class="gra1">
                    <h3 class="section-title mb-20"><span>Catégories</span> Populaires</h3>
                    <div class="firsthomecontent">
                        @foreach ($categories as $category)
                            <a href="{{ route('product.category', ['slug' => $category->slug]) }}" wire:navigate>
                                <div class="homecontent">
                                    <img class="lazyloaded" src="{{ $category->image }}" alt="{{ $category->name }}" srcset="">
                                    <p>{{ $category->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </fieldset>
            </div>


        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">En vedette</button>
                        </li>
                    </ul>
                    <a href="#" class="view-more d-none d-md-flex">Voir plus<i class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">

                            @forelse ($products as $product)

                                <div class="col-lg-2 col-md-2 col-sm-2 col-6 g-1">
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
                                            <h2><a href="{{ route('details', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h2>
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
                                                <a aria-label="Ajouter au panier" class="action-btn hover-up" wire:click.prevent="addToCart('{{$product->id}}','{{ addslashes($product->name) }}', 1, {{ $product->sale_price }})"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty

                                <h5>Aucun produit trouvé</h5>

                            @endforelse


                        </div>
                        <!--End product-grid-4-->
                    </div>
                </div>
                <!--End tab-content-->
            </div>
        </section>

        <div class="text-center">
            <button type="button" class="btn btn-warning btn-sm" wire:click.prevent='loadMore'>Afficher les autres</button>
        </div>

        <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Repair Services</h4>
                        <h1 class="fw-600 mb-20">We're an Apple <br>Authorised Service Provider</h1>
                        <a href="shop.html" class="btn">Learn More <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="popular-categories section-padding mt-15 mb-25" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Catégories</span> Populaires</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($popularycategories as $popularycategory)

                            <div class="card-1">
                                <figure class=" img-hover-scale overflow-hidden">
                                    <a href="{{ route('product.category', ['slug' => $popularycategory->slug]) }}"><img src="{{ $popularycategory->getImage() }}" alt=""  wire:navigate></a>
                                </figure>
                                <h5><a href="{{ route('product.category', ['slug' => $popularycategory->slug]) }}"  wire:navigate>{{ $popularycategory->name }}</a></h5>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-1.png" alt="">
                            <div class="banner-text">
                                <span>Smart Offer</span>
                                <h4>Save 20% on <br>Woman Bag</h4>
                                <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-2.png" alt="">
                            <div class="banner-text">
                                <span>Sale off</span>
                                <h4>Great Summer <br>Collection</h4>
                                <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated  mb-sm-0">
                            <img src="assets/imgs/banner/banner-3.png" alt="">
                            <div class="banner-text">
                                <span>New Arrivals</span>
                                <h4>Shop Today’s <br>Deals & Offers</h4>
                                <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Nouveaux</span> Produits</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($newproducts as $newproduct)

                            <div class="product-cart-wrap small hover-up">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('details', ['slug' => $newproduct->slug]) }}"  wire:navigate>
                                            <img class="default-img" src="{{ $newproduct->image }}" alt="">
                                            <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                            <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2><a href="{{ route('details', ['slug' => $newproduct->slug]) }}">{{ $newproduct->name }}</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>${{ $newproduct->sale_price }} </span>
                                        <span class="old-price">${{ $newproduct->regular_price }}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Meilleures</span> Ventes</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-3">
                        @foreach ($bestProducts as $bestProduct)

                            <div class="product-cart-wrap small hover-up">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('details', ['slug' => $bestProduct->slug]) }}" wire:navigate>
                                            <img class="default-img" src="{{ $bestProduct->image }}" alt="">
                                            <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                            <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2><a href="{{ route('details', ['slug' => $bestProduct->slug]) }}"  wire:navigate>{{ $bestProduct->name }}</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>${{ $bestProduct->sale_price }} </span>
                                        <span class="old-price">${{ $bestProduct->regular_price }}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding" wire:ignore>
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-4-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-4">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- @push('scripts')
        <script>
            // my next birthday
            const newDate = new Date('{{ Carbon\Carbon::parse($saleTimer->sale_time) }}').getTime()
            const countdown = setInterval(() =>{

            const date = new Date().getTime()
            const diff = newDate - date

            const month =  Math.floor((diff % (1000 * 60 * 60 * 24 * (365.25 / 12) * 365)) / (1000 * 60 * 60 * 24 * (365.25 / 12)))
            const days = Math.floor(diff % (1000 * 60 * 60 * 24 * (365.25 / 12)) / (1000 * 60 * 60 * 24))
            const hours =  Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
            const seconds = Math.floor((diff % (1000 * 60)) / 1000)

                document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
                document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes :minutes
                document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours
                document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days
                document.querySelector(".months").innerHTML = month < 10 ? '0' + month : month

            if(diff <= 0){
            clearInterval(countdown)
                    document.querySelector(".countdown").innerHTML = 'Happy Birthday Ahmed'
            }

            }, 1000)
        </script>
    @endpush --}}
</div>
