<div>
    <style>
        /* From Uiverse.io by Yaya12085 */
        .radio-inputs {
        display: flex;
        justify-content: center;
        align-items: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        .radio-inputs > * {
        margin: 6px;
        }

        .radio-input:checked + .radio-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        color: #2260ff;
        }

        .radio-input:checked + .radio-tile:before {
        transform: scale(1);
        opacity: 1;
        background-color: #2260ff;
        border-color: #2260ff;
        }

        .radio-input:checked + .radio-tile .radio-icon svg {
        fill: #2260ff;
        }

        .radio-input:checked + .radio-tile .radio-label {
        color: #2260ff;
        }

        .radio-input:focus + .radio-tile {
        border-color: #2260ff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
        }

        .radio-input:focus + .radio-tile:before {
        transform: scale(1);
        opacity: 1;
        }

        .radio-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 80px;
        min-height: 80px;
        border-radius: 0.5rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        transition: 0.15s ease;
        cursor: pointer;
        position: relative;
        }

        .radio-tile:before {
        content: "";
        position: absolute;
        display: block;
        width: 0.75rem;
        height: 0.75rem;
        border: 2px solid #b5bfd9;
        background-color: #fff;
        border-radius: 50%;
        top: 0.25rem;
        left: 0.25rem;
        opacity: 0;
        transform: scale(0);
        transition: 0.25s ease;
        }

        .radio-tile:hover {
        border-color: #2260ff;
        }

        .radio-tile:hover:before {
        transform: scale(1);
        opacity: 1;
        }

        .radio-icon svg {
        width: 2rem;
        height: 2rem;
        fill: #494949;
        }

        .radio-label {
        color: #707070;
        transition: 0.375s ease;
        text-align: center;
        font-size: 13px;
        }

        .radio-input {
        clip: rect(0 0 0 0);
        -webkit-clip-path: inset(100%);
        clip-path: inset(100%);
        height: 1px;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        width: 1px;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Accueil</a>
                    <span></span> Boutique
                    <span></span> Paiement
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <form method="post" wire:submit.prevent='placeOrder'>
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25 d-flex justify-content-between">
                            <h4>Adresse de livraison</h4>
                            {{-- <button class="btn btn-fill-out btn-block btn-sm " data-bs-toggle="modal" data-bs-target="#quickViewModal">Ajouter une adresse</button> --}}
                            <button class="btn btn-fill-out btn-block btn-sm btn-warning" wire:click='showAddShippingModal'>Ajouter une adresse</button>
                        </div>

                        <div class="row mb-20">
                            <div class="col-lg-12">
                                @forelse ($shippingAdresses as $shippingAdresse)

                                    <div class="toggle_info mt-2">

                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-3">
                                                <!-- From Uiverse.io by Yaya12085 -->
                                                <div class="radio-inputs" wire:click='applyShippingAdress("{{ $shippingAdresse->city }}")'>

                                                    <label>
                                                        <input class="radio-input" type="radio" name="adress_type" value="{{ $shippingAdresse->adress_type }}" wire:model='adress_type'>
                                                        <span class="radio-tile">
                                                            <span class="radio-icon">
                                                                <i class="fi-rs-home" style="font-size:30px"></i>
                                                            </span>
                                                            <span class="radio-label">{{ $shippingAdresse->adress_type }}</span>
                                                        </span>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <p>Type d'adresse : {{ $shippingAdresse->adress_type }}</p>
                                                <p>Nom : {{ $shippingAdresse->name }}</p>
                                                <p>Email : {{ $shippingAdresse->email }}</p>
                                                <p>Téléphone : {{ $shippingAdresse->phone }}</p>
                                                <p>Ville : {{ $shippingAdresse->city }}</p>
                                                <p>Adresse : {{ $shippingAdresse->adress }}</p>
                                            </div>
                                            <div class="col-md-3 text-center text-danger">
                                                <a href="" wire:click.prevent='showEditShippingModal({{ $shippingAdresse->id }})'><i class="fi-rs-pencil mr-10" style="font-size: 16px"></i></a>
                                                <a href="" wire:click.prevent='sendConfirm({{ $shippingAdresse->id }}, "warning", "Voulez-vous supprimer cette adresse", "Supprimer")'><i class="fi-rs-trash" style="font-size: 16px"></i></a>
                                            </div>
                                        </div>

                                    </div>

                                @empty

                                @endforelse
                            </div>
                        </div>

                            <div class="mb-20">
                                <h5>Informations supplémentaires</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes" wire:model='additional_onfo'></textarea>
                            </div>

                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Votre commande</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Produits</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $product)

                                            <tr>
                                                <td class="image product-thumbnail"><img src="{{ $product->model->image }}" alt="#"></td>
                                                <td>
                                                    <h5><a href="product-details.html">{{ $product->model->name }}</a> <span class="product-qty">x {{ $product->qty }}</span></h5>
                                                    <div>
                                                        @if ($product->options->color)
                                                        <span class="text-muted">Couleur : {{ ucwords($product->options->color) }}</span>
                                                        @endif
                                                        @if ($product->options->size)
                                                        <span class="text-muted">Taille : {{ $product->options->size }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>${{ $product->model->sale_price }}</td>
                                            </tr>

                                        @endforeach
                                        @if (session()->has('coupon'))
                                            <tr>
                                                <th>Sous-total</th>
                                                <td class="product-subtotal" colspan="2">${{ number_format(Cart::instance('cart')->subtotal(), 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Réduction</th>
                                                <td class="product-subtotal" colspan="2">-${{ number_format($discount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Sous-total après réduction</th>
                                                <td class="product-subtotal" colspan="2">${{ number_format($subtotalAfterDiscount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Livraison</th>
                                                <td colspan="2"><em>${{ $this->shippingCost }}</em></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{ number_format($totalAfterDiscount + $this->shippingCost, 2) }}</span></td>
                                            </tr>
                                        @else

                                            <tr>
                                                <th>Sous-total</th>
                                                <td class="product-subtotal" colspan="2">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Livraison</th>
                                                <td colspan="2"><em>${{ number_format($this->shippingCost, 2) }}</em></td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${{ Cart::instance('cart')->total() + $this->shippingCost }}</span></td>
                                            </tr>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Paiement</h5>
                                </div>
                                <div class="icheck-material-orange icheck-inline">
                                    <input type="radio" id="someRadioId1" name="someGroupName" value="cash" wire:ignore wire:model='paymentType' />
                                    <label for="someRadioId1">Après livraison</label>
                                </div>
                                <div class="icheck-material-orange icheck-inline">
                                    <input type="radio" id="someRadioId2" name="someGroupName" value="card" wire:ignore wire:model='paymentType' />
                                    <label for="someRadioId2">Carte bancaire</label>
                                </div>
                                <div class="icheck-material-orange icheck-inline">
                                    <input type="radio" id="someRadioId3" name="someGroupName" value="paypal" wire:ignore wire:model='paymentType' />
                                    <label for="someRadioId3">Paypal</label>
                                </div>

                            </div>
                            @error('paymentType') <span class="text-danger text-center">{{ $message }}</span> @enderror <br>
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Passer Commande</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <!-- Add Shipping Adress Model-->
            @include('livewire.partials.shipping.add-shipping-modal')

            <!-- Edit Shipping Adress Model-->
            @include('livewire.partials.shipping.edit-shipping-modal')

        </section>
    </main>
</div>
