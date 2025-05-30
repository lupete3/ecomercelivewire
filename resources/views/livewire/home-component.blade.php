<div>
    <main class="main">
        <section class="home-slider position-relative pt-5" wire:ignore>
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
                                        <p class="animated">{{ str_replace(':offer', $slider->offer, Lang::get('messages.slider_description', [], $locale)) }}
                                        </p>
                                        <a class="animated btn btn-brush btn-brush-3" href="{{ $slider->link }}">{{ Lang::get('messages.slider_button', [], $locale) }}
                                        </a>

                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 col-12">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated slider-1-1" src="{{ $slider->getImage() }}" alt="" style="width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding ">

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

                <fieldset class="row">
                    <h3 class="section-title mb-20 mt-20" ><span>{{ Lang::get('messages.categories_populaires', [], $locale) }}</h3>
                    <div class="firsthomecontent">
                        @foreach ($categories as $category)
                            <a href="{{ route('product.category', ['slug' => $category->slug]) }}" wire:navigate class="col-md-2 col-2">
                                <div class="homecontent">
                                    <img class="lazyloaded" src="{{ asset($category->getImage()) }}" alt="{{ $category->name }}" srcset="">
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
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">
                                {{ Lang::get('messages.featured', [], $locale) }}
                            </button>
                        </li>
                    </ul>
                    <a href="{{ route('shop') }}" class="view-more d-none d-md-flex" wire:navigate>
                        {{ Lang::get('messages.view_more', [], $locale) }}
                        <i class="fi-rs-angle-double-small-right"></i>
                    </a>                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @forelse ($products as $product)

                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 g-1">
                                    <div class="product-cart-wrap mb-10">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('details', ['slug' => $product->slug]) }}"  wire:navigate>
                                                    <img class="default-img" src="{{ asset($product->getImage()) }}" alt="">
                                                    <img class="hover-img" src="{{ asset($product->getImage()) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href='{{ route('product.category', ['slug' => $product->category->slug]) }}' wire:navigate>{{ $product->category->name }}</a>
                                            </div>
                                            <h2><a href="{{ route('details', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h2>
                                            <div class="product-price">
                                                @php
                                                    $adjustedPrice = $this->getAdjustedPrice($product);
                                                @endphp
                                                <span>${{ number_format($adjustedPrice, 2) }}</span>
                                                <span class="old-price">${{ number_format($product->regular_price, 2) }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @empty

                                <h5>{{ Lang::get('messages.no_products_found', [], $locale) }}</h5>

                            @endforelse

                        </div>
                        <!--End product-grid-4-->
                    </div>
                </div>
                <!--End tab-content-->
            </div>
        </section>

        <div class="text-center">
            <button type="button" class="btn btn-warning btn-sm" wire:click.prevent='loadMore'>
                {{ Lang::get('messages.view_more', [], $locale) }}
            </button>
        </div>
        <section class="popular-categories section-padding mt-15 mb-25" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>{{ Lang::get('messages.categories_populaires', [], $locale) }}</h3>

                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($popularycategories as $popularycategory)

                            <div class="card-1">
                                <figure class=" img-hover-scale overflow-hidden">
                                    <a href="{{ route('product.category', ['slug' => $popularycategory->slug]) }}" wire:navigate><img src="{{ $popularycategory->getImage() }}" alt=""></a>
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
                    @foreach ($newproducts as $index => $item)
                        @if ($index == 0)
                            <div class="col-lg-4 col-md-6">
                                <div class="banner-img wow fadeIn animated">
                                    <img src="{{ asset($item->getImage()) }}" alt="" >
                                    <div class="banner-text">
                                        <span>{{ $item->category->name }}</span>
                                        <h4>{{ $item->name }}</h4>
                                        <a href="{{ route('details', ['slug' => $item->slug]) }}" wire:navigate>{{ Lang::get('messages.slider_button', [], $locale) }} <i class="fi-rs-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @elseif ($index == 1)
                            <div class="col-lg-4 col-md-6">
                                <div class="banner-img wow fadeIn animated">
                                    <img src="{{ asset($item->getImage()) }}" alt="" >
                                    <div class="banner-text">
                                        <span>{{ $item->category->name }}</span>
                                        <h4>{{ $item->name }}</h4>
                                        <a href="{{ route('details', ['slug' => $item->slug]) }}" wire:navigate>{{ Lang::get('messages.slider_button', [], $locale) }} <i class="fi-rs-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @elseif ($index == 2)
                            <div class="col-lg-4 d-md-none d-lg-flex">
                                <div class="banner-img wow fadeIn animated  mb-sm-0">
                                    <img src="{{ asset($item->getImage()) }}" alt="" >
                                    <div class="banner-text">
                                        <span>{{ $item->category->name }}</span>
                                        <h4>{{ $item->name }}</h4>
                                        <a href="{{ route('details', ['slug' => $item->slug]) }}" wire:navigate>{{ Lang::get('messages.slider_button', [], $locale) }} <i class="fi-rs-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </section>
        <section class="section-padding" wire:ignore>
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>{{ Lang::get('messages.new_products', [], $locale) }}</h3>

                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($newproducts as $newproduct)

                            <div class="product-cart-wrap small hover-up">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('details', ['slug' => $newproduct->slug]) }}"  wire:navigate>
                                            <img class="default-img" src="{{ asset($newproduct->getImage()) }}" alt="">
                                            <img class="hover-img" src="{{ asset($newproduct->getImage()) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2><a href="{{ route('details', ['slug' => $newproduct->slug]) }}" wire:navigate>{{ $newproduct->name }}</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        @php
                                            $adjustedPrice = $this->getAdjustedPrice($newproduct);
                                        @endphp
                                        <span>${{ number_format($adjustedPrice, 2) }}</span>
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
                <h3 class="section-title mb-20">
                    <span>{{ Lang::get('messages.best_sellers', [], $locale) }}</span>
                </h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-3">
                        @foreach ($bestProducts as $bestProduct)

                            <div class="product-cart-wrap small hover-up">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('details', ['slug' => $bestProduct->slug]) }}" wire:navigate>
                                            <img class="default-img" src="{{ asset($bestProduct->getImage()) }}" alt="">
                                            <img class="hover-img" src="{{ asset($bestProduct->getImage()) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">

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
                                        @php
                                            $adjustedPrice = $this->getAdjustedPrice($bestProduct);
                                        @endphp
                                        <span>${{ number_format($adjustedPrice, 2) }}</span>
                                        <span class="old-price">${{ $bestProduct->regular_price }}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
