<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des articles commandés</title>
    <style>
        /* Styles CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }
        .responsive-table {
            width: 100%;
            border-collapse: collapse;
        }
        .responsive-table th, .responsive-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }
        .responsive-table th {
            background-color: #f8f8f8;
        }
        .responsive-table td {
            background-color: #ffffff;
        }
        @media only screen and (max-width: 600px) {
            .responsive-table td, .responsive-table th {
                display: block;
                width: 100%;
            }
            .responsive-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .responsive-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 50%;
                padding-right: 10px;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h3>Salut {{ $order->name }} !</h3>
        <p style="font-size: 16px">Merci d'avoir passé une commande dans notre magasin!</p>
        <p style="font-size: 16px">Nous avons le réel plaisir de vous informer que votre commande
            <b>#{{ $order->id }}</b> du {{ Carbon\Carbon::parse($order->created_at)->format('d m Y H:m:s') }}
            a été bien reçue et nous vous confirmons que le procesuss du traitement est encours!
            Dès qu'il sera fini, un mail de confirmation vous sera envoyé.</p>
        <hr>
        <h2>Vos articles commandés</h2>
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Article</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orederItems as $item)
                    <tr>
                        <td data-label="#">{{ $loop->index + 1 }}</td>
                        <td data-label="Image"><img src="{{ $item->product->image }}" style="width: 50px"></td>
                        <td data-label="Article">{{ $item->product->name }}</td>
                        <td data-label="Quantité">{{ $item->quantity}} Pc</td>
                        <td data-label="Prix unitaire">${{ $item->price }}</td>
                        <td data-label="Total">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align: end; font-weight: bold">Sous Total</td>
                    <td><b>${{ number_format($order->subtotal, 2) }}</b></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: end; font-weight: bold">Réduction</td>
                    <td><b>${{ number_format($order->discount, 2) }}</b></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: end; font-weight: bold">Frais Livraison</td>
                    <td><b>${{ number_format($order->shipping_cost, 2) }}</b></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: end; font-weight: bold">Sous Total</td>
                    <td><b>${{ number_format($order->total, 2) }}</b></td>
                </tr>
            </tbody>
        </table>
        <h2>Informations de livraison</h2>
        <table class="responsive-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cordonnées</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nom</td>
                    <td><b>{{ $order->name }}</b></td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td><b>{{ $order->phone }}</b></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><b>{{ $order->email }}</b></td>
                </tr>
                <tr>
                    <td>Ville</td>
                    <td><b>{{ $order->city }}</b></td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td><b>{{ $order->adress }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
