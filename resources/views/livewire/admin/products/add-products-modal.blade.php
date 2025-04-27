<div wire:ignore.self class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $editForm ? 'updateProduct' : 'addProduct' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">{{ $form_title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" wire:model="name" id="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="short_description" class="form-label">Description courte</label>
                            <input type="text" class="form-control" wire:model="short_description" id="short_description">
                            @error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="long_description" class="form-label">Description longue</label>
                            <textarea class="form-control" wire:model="long_description" id="long_description" rows="3"></textarea>
                            @error('long_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="regular_price" class="form-label">Prix régulier</label>
                            <input type="number" step="0.01" class="form-control" wire:model="regular_price" id="regular_price">
                            @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="sale_price" class="form-label">Prix de promotion</label>
                            <input type="number" step="0.01" class="form-control" wire:model="sale_price" id="sale_price">
                            @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="quantity" class="form-label">Quantité</label>
                            <input type="number" class="form-control" wire:model="quantity" id="quantity">
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-select" wire:model="category_id" id="category_id">
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image principale</label>
                            <input type="file" class="form-control" wire:model="image" id="image" key="{{ $fileInputId }}">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="" width="200px" class="img-thumbnail mt-2">
                            @elseif ($new_image)
                                <img src="{{ asset('admin/products/'.$new_image) }}" alt="" width="200px" class="img-thumbnail mt-2">
                            @endif
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="images" class="form-label">Autres images du produit</label>
                            <input type="file" class="form-control" wire:model="images" id="images" multiple>
                            @if ($images)
                                <div class="row mt-2">
                                    @foreach ($images as $img)
                                        <div class="col-3">
                                            <img src="{{ $img->temporaryUrl() }}" alt="" class="img-thumbnail" width="100px">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($editForm && $images_new && is_array($images_new))
                                <div class="row mt-2">
                                    @foreach ($images_new as $key => $img)
                                        <div class="col-md-3 mb-2 position-relative">
                                            <img src="{{ asset('admin/products/' . $img) }}" alt="Image existante" class="img-thumbnail" width="150">
                                            <i wire:click='sendConfirmRemoveImage({{ $key }}, "warning", "Voulez-vous supprimer cette image?", "Supprimer")'
                                                class="fi-rs-trash text-danger position-absolute top-0 end-0 m-1" style="font-size: 16px; cursor: pointer"></i>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='resetForm'>Annuler</button>
                    <button type="submit" class="btn btn-primary">{{ $editForm ? 'Mettre à jour' : 'Ajouter' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
