<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('cart') }}">
        <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
        <span class="pro-count blue">
            {{ Cart::instance('cart')->count() > 0 ? Cart::instance('cart')->count() : 0 }}
        </span>
    </a>
    @if (Cart::instance('cart')->count() > 0)
        <div class="cart-dropdown-wrap cart-dropdown-hm2">
            <ul>
                @forelse (Cart::instance('cart')->content() as $item)

                    <li>
                        <div class="shopping-cart-img">
                            <a href="product-details.html"><img alt="Surfside Media" src="{{ asset($item->model->image) }}"></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="{{ route('details', ['slug' => $item->id]) }}">{{ ucwords(Str::substr($item->model->name, 0, 15)) }}</a></h4>
                            <h4><span>{{ $item->qty }} × </span>${{ $item->model->sale_price }}</h4>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#" wire:click.prevent='removeToCart("{{ $item->rowId }}")'><i class="fi-rs-cross-small"></i></a>
                        </div>
                    </li>
                @empty



                @endforelse
            </ul>
            <div class="shopping-cart-footer">
                 <div class="shopping-cart-total">
                    <h4>Total <span>${{ Cart::total() }}</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="{{ route('cart') }}" class="outline" wire:navigate>Affichier le panier</a>
                    <a href="{{ route('checkout') }}" wire:navigate>Payer</a>
                </div>
            </div>
        </div>
    @endif
</div>
