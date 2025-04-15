<!-- Add Shipping Adress Model-->
<div class="modal fade " wire:ignore.self id="editSliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Titre de haut</label>
                            <input type="hidden" class="form-control" wire:model='idSlide' id="recipient-name">
                            <input type="text" class="form-control" wire:model='top_title' wire:keyup='generateSlug' id="recipient-name">
                            @error('top_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" wire:model='slug' id="recipient-name" placeholder="Slug">
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Titre principal</label>
                            <input type="text" class="form-control" wire:model='title' id="recipient-name" placeholder="Entrez le titre principal">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Sous titre</label>
                            <input type="text" class="form-control" wire:model='sub_title' id="recipient-name" placeholder="Entrez le sous titre">
                            @error('sub_title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Pourcentage de l'offre</label>
                            <input type="text" class="form-control" wire:model='offer' id="recipient-name" placeholder="Entrez le pourcentage de l'offre">
                            @error('offer') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Lien du slider</label>
                            <input type="text" wire:model='link' class="form-control" id="recipient-name" placeholder="Entrez le lien du slider">
                            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image du slider</label>
                            <input type="file" wire:model='image' class="form-control" id="recipient-name" placeholder="">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="" width="200px" class="img-thumbnail"> <br>
                            @elseif ($new_image)
                            <img src="{{ asset('admin/slider/'.$new_image) }}" alt="" width="200px" class="img-thumbnail"> <br>
                        @endif
                        <label for="">Date Début</label>
                        <div class="form-group">
                            <input type="date" wire:model='start_date' class="form-control" id="recipient-name" placeholder="Date Début">
                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Date Fin</label>
                            <input type="date" wire:model='end_date' class="form-control" id="recipient-name" placeholder="Date Fin">
                            @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="payment_method">

                            <div class="icheck-material-orange icheck-inline">
                                <input type="radio" id="someRadioId1" name="someGroupName" value="1" wire:ignore wire:model='status' />
                                <label for="someRadioId1">Actif</label>
                            </div>
                            <div class="icheck-material-orange icheck-inline">
                                <input type="radio" id="someRadioId2" name="someGroupName" value="0" wire:ignore wire:model='status' />
                                <label for="someRadioId2">Inactif</label>
                            </div>

                        </div>
                        @error('status') <span class="text-danger text-center">{{ $message }}</span> @enderror <br>


                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fill-out btn-block btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                <button type="submit" wire:click.prevent='addSlider' class="btn btn-fill-out btn-block btn-sm btn-primary">Ajouter</button>
            </div></form>
        </div>
    </div>
</div>
