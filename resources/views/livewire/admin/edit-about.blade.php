<div class="card" wire:ignore>
    <div class="card-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $form_title }}</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="updateAbout" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Titre</label>
                    <input type="hidden" class="form-control" wire:model='idAbout'>
                    <input type="text" wire:model='title' class="form-control">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="">Description</label>
                    <textarea wire:model='description' id="" cols="30" rows="10"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="">image</label>
                    <input type="file" class="form-control" wire:model='image'>

                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="" width="200px" class="img-thumbnail mt-2">
                @elseif ($new_image)
                    <img src="{{ asset('admin/about/'.$new_image) }}" alt="" width="200px" class="img-thumbnail mt-2">
                @endif

            </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-fill-out btn-block btn-sm btn-warning">Mettre à jour</button>
    </div></form>
</div>

