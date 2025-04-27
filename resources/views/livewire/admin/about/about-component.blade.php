
<div class="card">
    <div class="card-header">
        <h5 class="modal-title mb-0" id="exampleModalLabel">{{ $form_title }}</h5>
    </div>

        <div class="card-body">
            <form wire:submit.prevent="updateAbout" class="row">


            <input type="hidden" wire:model="idAbout">

            <div class="col-md-12 mb-3">
                <label class="form-label">Titre</label>
                <input type="text" wire:model.defer="title" class="form-control" placeholder="Entrez le titre">
                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Description</label>
                <textarea wire:model.defer="description" rows="5" class="form-control" placeholder="Entrez la description..."></textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" wire:model="image">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                {{-- Spinner de chargement --}}
                <div wire:loading wire:target="image" class="mt-2">
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <span>Chargement de l'image...</span>
                </div>

                {{-- Aperçu de l'image --}}
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-thumbnail mt-3" style="width: 200px;">
                @elseif ($new_image)
                    <img src="{{ asset('admin/about/' . $new_image) }}" alt="Image actuelle" class="img-thumbnail mt-3" style="width: 200px;">
                @endif
            </div>

        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save me-2"></i>Mettre à jour
            </button>
        </div>
    </form>
</div>
