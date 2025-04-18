<div class="card">
    <div class="card-header">
        <div class="shop-product-fillter mb-0">
            <div class="totall-product">
                <div class="sidebar-widget widget_search">
                    <div class="search-form">
                        <form action="">
                            <input type="search" name="search" wire:model.live='search' id="" placeholder="Rechercher........">
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
                            <li><a class="{{ $productPerPage == 10 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(10)'>10</a></li>
                            <li><a class="{{ $productPerPage == 20 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(20)'>20</a></li>
                            <li><a class="{{ $productPerPage == 30 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(30)'>30</a></li>
                            <li><a class="{{ $productPerPage == 40 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(40)'>40</a></li>
                            <li><a class="{{ $productPerPage == 60 ? 'active' : '' }}" wire:click.prevent='changeProductPerPage(60)'>60</a></li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-warning btn-sm" wire:click.prevent='showAddSliderModal'>Ajouter</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre de haut</th>
                        <th>Titre principal</th>
                        <th>Sous-titre</th>
                        <th>Offre</th>
                        <th>Image</th>
                        <th>Date Début</th>
                        <th>Date Fin</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($sliders as $index => $slider)

                        <tr wire:key="slider-{{ $slider->id }}">
                            <td>{{ $index + $sliders->firstItem() }}</td>
                            <td>{{ $slider->top_title }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->sub_title }}</td>
                            <td>{{ $slider->offer }}</td>
                            <td><img src="{{ $slider->getImage() }}" alt="" width="55px" srcset=""></td>
                            <td>{{ $slider->start_date }}</td>
                            <td>{{ $slider->end_date }}</td>
                            <td>{{ $slider->type }}</td>
                            <td><p class="text-center {{ $slider->status == 1 ? 'bg-3' : 'bg-6' }}">{{ $slider->status == 1 ? 'Actif' : 'Inactif' }}</p></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="" wire:click.prevent='showEditSliderModal({{ $slider->id }})'><i class="fi-rs-pencil mr-10 text-info" style="font-size: 16px"></i></a>
                                    <a href="" wire:click.prevent='sendConfirm({{ $slider->id }}, "warning", "Voulez-vous supprimer ce slider?", "Supprimer")'><i class="fi-rs-trash" style="font-size: 16px"></i></a>
                                </div>
                            </td>
                        </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>

            {{ $sliders->links() }}
        </div>
    </div>

    @include('livewire.admin.slider.add-slider-modal')
</div>
