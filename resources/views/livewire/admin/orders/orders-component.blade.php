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
                            <span> {{ $ordersPerPage }} <i class="fi-rs-angle-small-down"></i></span>
                        </div>
                    </div>
                    <div class="sort-by-dropdown">
                        <ul>
                            <li><a class="{{ $ordersPerPage == 10 ? 'active' : '' }}" wire:click.prevent='changeOrdersPerPage(10)'>10</a></li>
                            <li><a class="{{ $ordersPerPage == 20 ? 'active' : '' }}" wire:click.prevent='changeOrdersPerPage(20)'>20</a></li>
                            <li><a class="{{ $ordersPerPage == 30 ? 'active' : '' }}" wire:click.prevent='changeOrdersPerPage(30)'>30</a></li>
                            <li><a class="{{ $ordersPerPage == 40 ? 'active' : '' }}" wire:click.prevent='changeOrdersPerPage(40)'>40</a></li>
                            <li><a class="{{ $ordersPerPage == 60 ? 'active' : '' }}" wire:click.prevent='changeOrdersPerPage(60)'>60</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Adresse</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $index => $order)
                    <tr wire:key="order-{{ $order->id }}">
                        <td>{{ $index + $orders->firstItem() }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->city }}</td>
                        <td>{{ $order->adress }}</td>
                        <td>{{ number_format($order->total, 2) }} Fc</td>
                        <td>
                            @php
                                $statusList = [
                                    'ordered' => ['label' => 'Commandée', 'class' => 'badge bg-secondary'],
                                    'processing' => ['label' => 'En traitement', 'class' => 'badge bg-warning text-dark'],
                                    'shipped' => ['label' => 'Expédiée', 'class' => 'badge bg-info text-dark'],
                                    'delivered' => ['label' => 'Livrée', 'class' => 'badge bg-success'],
                                    'cancelled' => ['label' => 'Annulée', 'class' => 'badge bg-danger'],
                                ];
                            @endphp

                            <span class="{{ $statusList[$order->status]['class'] }}">
                                {{ $statusList[$order->status]['label'] }}
                            </span>
                        </td>

                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" class="text-info" wire:click.prevent="showDetails({{ $order->id }})"> <i class="fi-rs-eye"></i> Détails</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center">Aucune commande trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>


    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning text-white">
              <h5 class="modal-title">Détails de la commande #{{ $selectedOrder?->id }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">

              @if ($selectedOrder)
                  <p><strong>Client :</strong> {{ $selectedOrder->name }} | {{ $selectedOrder->phone }}</p>
                  <p><strong>Adresse :</strong> {{ $selectedOrder->adress }}, {{ $selectedOrder->city }}</p>

                  <table class="table table-bordered mt-3">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Prix</th>
                              <th>Quantité</th>
                              <th>Sous-total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($selectedOrder->orderItems as $item)
                              <tr>
                                  <td>{{ $item->product->name ?? 'Produit supprimé' }}</td>
                                  <td>{{ number_format($item->price, 2) }} €</td>
                                  <td>{{ $item->quantity }}</td>
                                  <td>{{ number_format($item->price * $item->quantity, 2) }} €</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>

                  <div class="text-end">
                      <p><strong>Frais de livraison :</strong> {{ number_format($selectedOrder->shipping_cost, 2) }} €</p>
                      <p><strong>Total :</strong> {{ number_format($selectedOrder->total, 2) }} €</p>
                  </div>
                  <div class="d-flex justify-content-between">
                        {{-- <button class="btn btn-sm btn-outline-warning" onclick="window.print()">
                            <i class="fi-rs-printer"></i> Imprimer
                        </button> --}}

                        @if ($selectedOrder)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Statut de la commande :</label>
                                <div class="d-flex gap-3 flex-wrap">
                                    @foreach ([
                                        'ordered' => 'Commandée',
                                        'processing' => 'En traitement',
                                        'shipped' => 'Expédiée',
                                        'delivered' => 'Livrée',
                                        'cancelled' => 'Annulée',
                                    ] as $value => $label)
                                        <label class="{{ $selectedOrder->status === $value ? 'active' : '' }}">
                                            <input type="radio" wire:click="updateStatus('{{ $value }}')" name="status"
                                                value="{{ $value }}" {{ $selectedOrder->status === $value ? 'checked' : '' }}>
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
              @endif

            </div>
          </div>
        </div>
    </div>


</div>
