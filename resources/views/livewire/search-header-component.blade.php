<div class="search-style-1">
    <form action="{{ route('product.search') }}">
        <input type="text" name="search" wire:model='search' value="{{ $search }}" placeholder="Rechercher par produit...">
    </form>
</div>
