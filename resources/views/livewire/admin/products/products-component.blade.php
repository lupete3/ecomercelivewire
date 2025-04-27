<div class="card">
    <div class="card-header">
        <div class="shop-product-fillter mb-0">
            <div class="totall-product">
                <div class="sidebar-widget widget_search">
                    <div class="search-form">
                        <form action="">
                            <input type="search" name="search" wire:model.live='search' placeholder="Rechercher un produit...">
                            <button type="submit"><i class="fi-rs-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sort-by-product-area">
                <div class="sort-by-cover mr-10">
                    <div class="sort-by-product-wrap">
                        <div class="sort-by">
                            <span><i class="fi-rs-apps"></i>Voir:</span>
                        </div>
                        <div class="sort-by-dropdown-wrap">
                            <span> {{ $productPerPage }} <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            @foreach ([10, 20, 30, 40, 60] as $nb)
                                <li><a class="{{ $productPerPage == $nb ? 'active' : '' }}" wire:click.prevent='changeProductPerPage({{ $nb }})'>{{ $nb }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button class="btn btn-success btn-sm" wire:click.prevent='showAddProductModal'>Ajouter</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Prix régulier</th>
                        <th>Prix promo</th>
                        <th>Quantité</th>
                        <th>Image</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                        <tr wire:key="product-{{ $product->id }}">
                            <td>{{ $index + $products->firstItem() }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ Str::limit($product->short_description, 30) }}</td>
                            <td>{{ number_format($product->regular_price, 2) }} $</td>
                            <td>{{ number_format($product->sale_price, 2) }} $</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->getImage()) }}" width="60" alt="image">
                                @endif
                            </td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <i wire:click.prevent='showEditProductModal({{ $product->id }})' class="fi-rs-pencil text-info" style="font-size: 16px; cursor: pointer"></i>
                                    <i wire:click.prevent='sendConfirm({{ $product->id }}, "warning", "Voulez-vous supprimer ce produit?", "Supprimer")' class="fi-rs-trash text-danger" style="font-size: 16px; cursor: pointer"></i>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Aucun produit trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </div>

    @include('livewire.admin.products.add-products-modal')
</div>
