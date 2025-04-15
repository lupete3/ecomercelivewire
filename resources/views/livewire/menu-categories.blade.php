<div>
    @foreach ($categories as $category)
        <li><a href='{{ route('product.category', ['slug' => $category->slug]) }}' wire:navigate>{{ $category->name }}</a></li>
    @endforeach
</div>
