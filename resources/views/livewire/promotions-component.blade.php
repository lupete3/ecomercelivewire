<div>
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="bg-square"></div>
        <div class="container">
            <div class="tab-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">En vedette</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Populaires</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Nouveaux</button>
                    </li>
                </ul>
                <a href="#" class="view-more d-none d-md-flex">Voir plus<i class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">

                        @forelse ($products as $product)

                            <div class="col-lg-2 col-md-2 col-6 col-sm-6 g-1">
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

            <div x-intersect.full="$wire.infiteScroll">
                Afficher plus
            </div>



        </div>
    </section>

    @push('scripts')
        <script>
            window.onscroll = function(){
                    if((window.innerHeight + wondow.scrollY) >= document.body.offsetHeight - 500){
                        window.livewire.emit('promotions-component');
                    }
                }
        </script>
    @endpush
</div>
