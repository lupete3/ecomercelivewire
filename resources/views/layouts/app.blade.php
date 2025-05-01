<!DOCTYPE html>
<html class="no-js" lang="fr">

    <head>

        <meta charset="utf-8">
        <title>Surfside Media</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="">
        <meta property="og:type" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}assets/imgs/theme/favicon.ico">

        <link rel="stylesheet" href="{{ asset('/') }}assets/css/main.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/custom.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/button.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/icheck/icheck-material.min.css">


        @livewireStyles

    </head>

    <body>
        
        <!-- Header Principale-->
        @livewire('layouts.app-layout-component')

        @yield('content')

        @livewire('layouts.footer-layout-component')



        <!-- Vendor JS-->
        <script src="{{ asset('/') }}assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
        <script src="{{ asset('/') }}assets/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/slick.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.syotimer.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/wow.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery-ui.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/perfect-scrollbar.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/magnific-popup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/select2.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/waypoints.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/counterup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.countdown.min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/images-loaded.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/isotope.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/scrollup.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.vticker-min.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.theia.sticky.js"></script>
        <script src="{{ asset('/') }}assets/js/plugins/jquery.elevatezoom.js"></script>
        <!-- Template  JS -->
        <script src="{{ asset('/') }}assets/js/main.js?v=3.3"></script>
        <script src="{{ asset('/') }}assets/js/shop.js?v=3.3"></script>

        <script src="{{ asset('/') }}assets/js/sweetalert2.all.min.js"></script>

        <script>

            window.addEventListener('openAddShippingModal', event => {
                $('#addShippingModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideAddShippingModal', event => {
                $('#addShippingModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('openEditShippingModal', event => {
                $('#editShippingModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideEditShippingModal', event => {
                $('#editShippingModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('showAddSliderModal', event => {
                $('#addSliderModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('showEditSliderModal', event => {
                $('#addSliderModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideAddSliderModal', event => {
                $('#addSliderModal').modal('hide'); // Affiche la modale
            });


            window.addEventListener('showAddCategoryModal', event => {
                $('#addCategoryModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideAddCategoryModal', event => {
                $('#addCategoryModal').modal('hide'); // Affiche la modale
            });


            window.addEventListener('showEditCategoryModal', event => {
                $('#editCategoryModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideEditCategoryModal', event => {
                $('#editCategoryModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('showAddProductModal', event => {
                $('#addProductModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideAddProductModal', event => {
                $('#addProductModal').modal('hide'); // Affiche la modale
            });



            window.addEventListener('openEditShippingModal', event => {
                $('#editShippingModal').modal('show'); // Affiche la modale
            });
            window.addEventListener('hideEditShippingModal', event => {
                $('#editShippingModal').modal('hide'); // Affiche la modale
            });

            window.addEventListener('hideOrderDetailsModal', event => {
                $('#orderDetailsModal').modal('hide'); // Affiche la modale
            });
            window.addEventListener('showOrderDetailsModal', event => {
                $('#orderDetailsModal').modal('show'); // Affiche la modale
            });

            //Confim before delete shipping adress
            window.addEventListener('clientConfirm', (event) => {

                Swal.fire({

                    // icon: event.detail.type,
                    title: event.detail.title,
                    html: event.detail.message,
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#33cc33',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Non',
                    confirmButtonText: 'Oui'

                })

                .then((result) => {

                    if (result.isConfirmed) {
                        Livewire.dispatch(event.detail.action, {id: event.detail.id});
                    } else {
                        Livewire.dispatch('makeActionCancel', {id: event.detail.id});
                    }
                });
            })


        </script>

        @stack('scripts')

        @livewireScripts

    </body>

</html>
