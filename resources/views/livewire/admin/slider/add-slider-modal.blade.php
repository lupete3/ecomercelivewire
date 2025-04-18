<div wire:ignore.self class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="addSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $editForm ? 'updateSlider' : 'addSlider' }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSliderModalLabel">{{ $form_title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Affichage des erreurs --}}
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
                            <label for="topTitle" class="form-label">Top Title</label>
                            <input type="text" class="form-control" wire:model='top_title' id="topTitle">
                            @error('top_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" wire:model='slug' id="slug">
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model='title' id="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="subTitle" class="form-label">Sub Title</label>
                            <input type="text" class="form-control" wire:model='sub_title' id="subTitle">
                            @error('sub_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="offer" class="form-label">Offer</label>
                            <input type="text" class="form-control" wire:model='offer' id="offer">
                            @error('offer') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="link" class="form-label">Lien</label>
                            <input type="text" class="form-control" wire:model='link' id="link">
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" wire:model='new_image' id="image">
                            @if ($new_image)
                            <img src="{{ $new_image->temporaryUrl() }}" alt="" width="200px" class="img-thumbnail mt-2">
                            @elseif ($image)
                            {{ $image }}
                                <img src="{{ asset('admin/slder/'.$image) }}" alt="" width="200px" class="img-thumbnail mt-2">
                            @endif
                            @error('new_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Statut</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="status" name="statusGroup" id="actif" value="1">
                                <label class="form-check-label" for="actif">Actif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model="status" name="statusGroup" id="inactif" value="0">
                                <label class="form-check-label" for="inactif">Inactif</label>
                            </div>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="startDate" class="form-label">Date de début</label>
                            <input type="date" class="form-control" wire:model="start_date" id="startDate">
                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="endDate" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" wire:model="end_date" id="endDate">
                            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">{{ $editForm ? 'Mettre à jour' : 'Ajouter' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
