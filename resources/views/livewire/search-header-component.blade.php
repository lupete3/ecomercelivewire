<form action="{{ route('product.search') }}">
    <input type="text" name="search" wire:model='search' value="{{ $search }}" placeholder="{{ Lang::get('messages.search_placeholder', [], $locale) }}">
    <button type="submit"><i class="fi-rs-search"></i></button>
</form>
