<div class="header-action-icon-2">
    <a href="{{ route('wishlist') }}" wire:navigate>
        <img class="svgInject" alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-heart.svg') }}">
        <span class="pro-count blue">{{ Cart::instance('wishlist')->count() > 0 ? Cart::instance('wishlist')->count() : 0 }}</span>
    </a>
</div>
