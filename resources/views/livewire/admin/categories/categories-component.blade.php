<div class="container">
    <div class="card mt-2">
        <div class="card-header">
            <div class="shop-product-fillter mb-0">
                <div class="totall-product">
                    <div class="sidebar-widget widget_search">
                        <div class="search-form">
                            <form action="">
                                <input type="search" name="search" wire:model.live='search' placeholder="Rechercher...">
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
                                <span> {{ $categoriesPerPage }} <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="{{ $categoriesPerPage == 10 ? 'active' : '' }}" wire:click.prevent='changeCategoryPerPage(10)'>10</a></li>
                                <li><a class="{{ $categoriesPerPage == 20 ? 'active' : '' }}" wire:click.prevent='changeCategoryPerPage(20)'>20</a></li>
                                <li><a class="{{ $categoriesPerPage == 30 ? 'active' : '' }}" wire:click.prevent='changeCategoryPerPage(30)'>30</a></li>
                            </ul>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-sm" wire:click.prevent='showAddCategoryModal'>Ajouter</button>
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
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr wire:key="category-{{ $category->id }}">
                                <td>{{ $index + $categories->firstItem() }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if ($category->getImage())
                                        <img src="{{ asset($category->getImage()) }}" width="55px">
                                    @else
                                        <span class="text-muted">Aucune</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="text-center {{ $category->status ? 'bg-3' : 'bg-6' }}">
                                        {{ $category->status ? 'Actif' : 'Inactif' }}
                                    </p>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="" wire:click.prevent='showEditCategoryModal({{ $category->id }})'><i class="fi-rs-pencil mr-10 text-info" style="font-size: 16px"></i></a>
                                        <a href="" wire:click.prevent='sendConfirm({{ $category->id }}, "warning", "Voulez-vous supprimer cette catégorie ?", "Supprimer")'><i class="fi-rs-trash" style="font-size: 16px"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune catégorie trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $categories->links() }}
            </div>
        </div>

        @include('livewire.admin.categories.add-categories-modal')

    </div>

</div>
