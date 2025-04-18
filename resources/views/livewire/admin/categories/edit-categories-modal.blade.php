<!-- Modal Ajouter/Modifier une Catégorie -->
<div class="modal fade" wire:ignore.self id="editCategoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $form_title }}</h5>
                <button type="button" class="btn-close" wire:click.prevent='hideEditCategoryModal'></button>
            </div>
            <div class="modal-body">
                <form method="post" class="row">

                    <div class="col-md-12">
                        <input type="text" wire:model='idCategory'>

                        <div class="form-group mb-2">
                            <label for="">Nom de la catégorie</label>
                            <input type="text" class="form-control" wire:model='name' wire:keyup='generateSlug' placeholder="Nom de la catégorie">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <input type="hidden" wire:model='slug'>
                        @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

                        <div class="form-group mb-2">
                            <label for="">Image de la catégorie</label>
                            <input type="file" wire:model='image' class="form-control">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="" width="200px" class="img-thumbnail mt-2">
                        @elseif ($new_image)
                            <img src="{{ asset('admin/categories/'.$new_image) }}" alt="" width="200px" class="img-thumbnail mt-2">
                        @endif

                        <div class="mt-3">
                            <label for="">Statut</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="statusActive" value="1" wire:model='status'>
                                <label class="form-check-label" for="statusActive">Actif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="statusInactive" value="0" wire:model='status'>
                                <label class="form-check-label" for="statusInactive">Inactif</label>
                            </div>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
            </div>

            <div class="modal-footer">

                @if ($editCategoryForm)
                    <button type="button" wire:click.prevent='hideAddCategoryModal' class="btn btn-secondary btn-sm">Fermer</button>
                    <button type="submit" wire:click.prevent='updateCategory' class="btn btn-warning btn-sm">Modifier</button>
                @else
                    <button type="button" wire:click.prevent='hideAddCategoryModal' class="btn btn-secondary btn-sm">Fermer</button>
                    <button type="submit" wire:click.prevent='addCategory' class="btn btn-primary btn-sm">Ajouter</button>
                @endif
            </div>

            </form>
        </div>
    </div>
</div>
