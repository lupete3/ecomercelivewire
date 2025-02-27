<!-- Edit Shipping Adress Model-->
<div class="modal fade" wire:ignore.self id="editShippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Information de livraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="radio-inputs mb-2">

                        <label>
                            <input class="radio-input" type="radio" wire:model="adress_type" value="Domicile" wire:ignore>
                            <span class="radio-tile">
                                <span class="radio-icon">
                                    <i class="fi-rs-home" style="font-size:30px"></i>
                                </span>
                                <span class="radio-label">Domicile</span>
                            </span>
                        </label>

                        <label>
                            <input class="radio-input" type="radio" wire:model="adress_type" value="Bureau" wire:ignore>
                            <span class="radio-tile">
                                <span class="radio-icon">
                                    <i class="fi-rs-home" style="font-size:30px"></i>
                                </span>
                                <span class="radio-label">Bureau</span>
                            </span>
                        </label>

                        <label>
                            <input class="radio-input" type="radio" wire:model="adress_type" value="Autre" wire:ignore>
                            <span class="radio-tile">
                                <span class="radio-icon">
                                    <i class="fi-rs-home" style="font-size:30px"></i>
                                </span>
                                <span class="radio-label">Autre</span>
                            </span>
                        </label>

                    </div>
                    @error('adress_type') <span class="text-danger text-center">{{ $message }}</span> @enderror


                    <div class="form-group">
                        <input type="text" class="form-control" wire:model='name' id="recipient-name" placeholder="Entrez votre nom complet">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" wire:model='phone' id="recipient-name" placeholder="Entrez votre numéro de téléphone">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" wire:model='email' id="recipient-name" placeholder="Entrez votre adresse mail">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <select name="" wire:model='city' id="" class="form-control">
                            <option value="">Choisir votre ville</option>
                            <option value="Bukavu">Bukavu</option>
                            <option value="Goma">Goma</option>
                            <option value="Kamituga">Kamituga</option>
                            <option value="Uvira">Uvira</option>
                            <option value="Lubumbashi">Lubumbashi</option>
                        </select>
                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" wire:model='adress' class="form-control" id="recipient-name" placeholder="Entrez votre adresse de livraison">
                        @error('adress') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fill-out btn-block btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fermer</button>
                <button type="submit" wire:click.prevent='updateShipping' class="btn btn-fill-out btn-block btn-sm btn-primary">Mettre à jour</button>
            </div></form>
        </div>
    </div>
</div>
