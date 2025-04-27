<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow" wire:navigate>Accueil</a>
                    <span></span> Boutique
                    <span></span> Votre Panier
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                @if (Cart::instance('cart')->count() > 0)

                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="table-responsive">
                                <table class="table shopping-summery text-center clean">
                                    <thead>
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $row)
                                            <tr>
                                                <td class="image product-thumbnail"><img src="{{ asset('admin/products/'.$row->model->image) }}" alt="#"></td>
                                                <td class="product-des product-name">
                                                    <h5 class="product-name"><a href="{{ route('details', ['slug' => $row->model->slug]) }}">{{ $row->model->name }}</a>
                                                        <div>
                                                            @if ($row->options->color)
                                                            <span class="text-muted">Couleur : {{ ucwords($row->options->color) }}</span>
                                                            @endif
                                                            @if ($row->options->size)
                                                            <span class="text-muted">Taille : {{ $row->options->size }}</span>
                                                            @endif
                                                        </div>
                                                    </h5>
                                                </td>
                                                <td class="price" data-title="Price"><span>${{ $row->price }} </span></td>

                                                <td class="text-center" data-title="Stock">
                                                    <div class="quantity-field" >
                                                        <button
                                                          class="value-button decrease-button"
                                                          wire:click.prevent="reduceQuantityToCart('{{ $row->rowId }}')">-</button>
                                                          <div class="number">{{ $row->qty }}</div>
                                                        <button
                                                          class="value-button increase-button"
                                                          wire:click.prevent="addQuantityToCart('{{ $row->rowId }}')">+
                                                        </button>
                                                      </div>
                                                </td>
                                                <td class="text-right" data-title="Cart">
                                                    <span>${{ $row->subtotal() }} </span>
                                                </td>
                                                <td class="action" data-title="Remove"><a class="text-muted"
                                                    wire:click.prevent="removeToCart('{{ $row->rowId }}')"><i class="fi-rs-trash"></i></a></td>
                                            </tr>

                                    @endforeach
                                        <tr>
                                            <td colspan="6" class="text-end">
                                                <a class="text-muted" wire:click.prevent='destroyCart()'> <i class="fi-rs-cross-small"></i> Vider le panier</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-action text-end">
                                <a href="{{ route('shop') }}" class="btn "><i class="fi-rs-shopping-bag mr-10"></i>Continuer l'achat</a>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals">
                                <div class="heading_s1 mb-3">
                                    <h4>Total Panier</h4>
                                </div>
                                <div class="table-responsive">
                                    @if (session()->has('coupon'))
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Sous-total</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ number_format(Cart::instance('cart')->subtotal(), 2) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Réduction ({{ session()->get('coupon')['coupon_code'] }})</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">-${{ number_format($discount, 2) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Sous-total après réduction</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ number_format($subtotalAfterDiscount, 2) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tax</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ number_format($taxAfterDiscount, 2) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Livraison</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Livraison Gratuite</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{ number_format($totalAfterDiscount, 2) }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else

                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Sous-total</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{ Cart::subtotal() }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Livraison</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Livraison Gratuite</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{ Cart::total() }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                @if (!session()->has('coupon'))

                                    <div class="mb-20 mt-10">
                                        <div class="total-amount">
                                            <div class="left">
                                                <div class="coupon">
                                                    <form action="#" target="_blank">
                                                        <div class="form-row row justify-content-center">
                                                            <div class="form-group col-lg-7">
                                                                <input class="font-medium" name="Coupon" wire:model.defer='couponCode' placeholder="Entrer votre Coupon">
                                                            </div>
                                                            <div class="form-group col-lg-5">
                                                                <button class="btn  btn-sm" type="submit" wire:click.prevent='upplyCoupon'><i class="fi-rs-label mr-10"></i>Appliquer</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <a class="btn w-100" href="{{ route('checkout') }}" wire:navigate> <i class="fi-rs-box-alt mr-10"></i> Procéder au paiement</a>
                            </div>
                        </div>
                    </div>

                @else
                <div class="card">
                    <div class="card-body text-center">

                        <h4>Aucun produit trouvé dans votre panier</h4>
                        <p class=" mt-2"><i class="fi-rs-shopping-cart" style="font-size: 700%"></i></p>
                    </div>
                </div>
                @endif
                <div class="divider center_icon mt-20 mb-20 col-lg-12 col-md-12" ><i class="fi-rs-fingerprint"></i></div>
                <h3 class="section-title mb-20"><span>Autres produits</span> qui peuvent vous intéresser</h3>
                <div class="row product-grid-2">
                    @forelse ($products as $product)

                        <div class="col-lg-2 col-md-4 col-6 col-sm-6 g-2">
                            <div class="product-cart-wrap mb-20">
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
                                    <h2><a href="product-details.html">{{ $product->name }}</a></h2>
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
            </div>
        </section>
    </main>
</div>
