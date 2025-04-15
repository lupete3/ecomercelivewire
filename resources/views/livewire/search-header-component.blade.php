<form action="{{ route('product.search') }}">
    <input type="text" name="search" wire:model='search' value="{{ $search }}" placeholder="Rechercher par produit...">
    <button type="submit"><i class="fi-rs-search"></i></button>
</form>
