<!-- Add Shipping Address Modal -->
<div class="modal fade" wire:ignore.self id="addShippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ Lang::get('messages.shipping_info', [], $locale) }}</h5>
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
                                <span class="radio-label">{{ Lang::get('messages.home', [], $locale) }}</span>
                            </span>
                        </label>

                        <label>
                            <input class="radio-input" type="radio" wire:model="adress_type" value="Bureau" wire:ignore>
                            <span class="radio-tile">
                                <span class="radio-icon">
                                    <i class="fi-rs-home" style="font-size:30px"></i>
                                </span>
                                <span class="radio-label">{{ Lang::get('messages.office', [], $locale) }}</span>
                            </span>
                        </label>

                        <label>
                            <input class="radio-input" type="radio" wire:model="adress_type" value="Autre" wire:ignore>
                            <span class="radio-tile">
                                <span class="radio-icon">
                                    <i class="fi-rs-home" style="font-size:30px"></i>
                                </span>
                                <span class="radio-label">{{ Lang::get('messages.other', [], $locale) }}</span>
                            </span>
                        </label>
                    </div>
                    @error('adress_type') <span class="text-danger text-center">{{ $message }}</span> @enderror

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model='name' id="recipient-name" placeholder="{{ Lang::get('messages.full_name', [], $locale) }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model='phone' id="recipient-name" placeholder="{{ Lang::get('messages.phone_number', [], $locale) }}">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" wire:model='email' id="recipient-name" placeholder="{{ Lang::get('messages.email_address', [], $locale) }}">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ Lang::get('messages.select_country', [], $locale) }}</label>
                        <select name="" wire:model='city' id="" class="form-control">
                            @foreach ($city as $fr => $en)
                                <option value="{{ $locale === 'fr' ? $fr : $en }}">
                                    {{ $locale === 'fr' ? $fr : $en }}
                                </option>
                            @endforeach
                        </select>
                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" wire:model='adress' class="form-control" id="recipient-name" placeholder="{{ Lang::get('messages.delivery_address', [], $locale) }}">
                        @error('adress') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fill-out btn-block btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    {{ Lang::get('messages.close', [], $locale) }}
                </button>
                <button type="button" wire:click.prevent='addShipping' class="btn btn-fill-out btn-block btn-sm btn-primary">
                    {{ Lang::get('messages.add', [], $locale) }}
                </button>
            </div>
        </div>
    </div>
</div>






