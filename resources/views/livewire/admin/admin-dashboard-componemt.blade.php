<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow">Accueil</a>
                <span></span> Mon compte
            </div>
        </div>
    </div>
    <section class="pt-10 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row g-1">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Tableau de Bord</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Commandes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sliders-tab" data-bs-toggle="tab" href="#sliders" role="tab" aria-controls="sliders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Sliders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="categories-tab" data-bs-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Catégories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-product-tab" data-bs-toggle="tab" href="#track-product" role="tab" aria-controls="track-product" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Produits</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>A propos de nous</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Tracer vos Commandes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>Mon Addresses</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Détail du profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.html"><i class="fi-rs-sign-out mr-10"></i>Déconnexion</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Hello Rosie! </h5>
                                        </div>
                                        <div class="card-body">
                                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    @livewire('admin.orders.orders-component')
                                </div>
                                <div class="tab-pane fade" id="sliders" role="tabpanel" aria-labelledby="sliders-tab">
                                    @livewire('admin.slider.slider-component')
                                </div>
                                <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                                    @livewire('admin.categories.categories-component')
                                </div>
                                <div class="tab-pane fade" id="track-product" role="tabpanel" aria-labelledby="track-product-tab">
                                    @livewire('admin.products.products-component')
                                </div>
                                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    @livewire('admin.about.about-component')
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Orders tracking</h5>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id" placeholder="Found in your order confirmation email" type="text" class="square">
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email" placeholder="Email you used during checkout" type="email" class="square">
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Billing Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>000 Interstate<br> 00 Business Spur,<br> Sault Ste. <br>Marie, MI 00000</address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>4299 Express Lane<br>
                                                        Sarasota, <br>FL 00000 USA <br>Phone: 1.000.000.0000</address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Already have an account? <a href="login.html">Log in instead!</a></p>
                                            <form method="post" name="enq">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>First Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="name" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="phone">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Display Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="dname" type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="email" type="email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="password" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="npassword" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="cpassword" type="password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
