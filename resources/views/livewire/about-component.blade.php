<main class="main single-page">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow">Accueil</a>
                <span></span> A propos de nous
            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container pt-25">
            <div class="row">
                <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                    <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">Notre Organisation</h6>
                    <h1 class="font-heading mb-40">
                        {{ $about->title }}
                    </h1>
                    <p>{{ $about->description }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('/'.$about->image) }}" alt="">
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="testimonials" class="section-padding">
        <div class="container pt-25">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-10 text-uppercase  text-brand font-sm wow fadeIn animated">some facts</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">Take a look what<br> our clients say about us</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated">At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium. ebitis nesciunt voluptatum dicta reprehenderit accusamus</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-1.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                J. Bezos
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-3.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B.Gates
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-2.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B. Meyers
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-4.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                J. Bezos
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-5.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B.Gates
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                        <div class="hero-card-icon icon-left-2 hover-up ">
                            <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted" src="{{ asset('/') }}assets/imgs/page/avatar-1.jpg" alt="">
                        </div>
                        <div class="pl-30">
                            <h5 class="mb-5 fw-500">
                                B. Meyers
                            </h5>
                            <p class="font-sm text-grey-5">Adobe Jsc</p>
                            <p class="text-grey-3">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis nesciunt voluptatum dicta reprehenderit accusamus voluptatibus voluptas."</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-12 text-center">
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg">View More</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding">
        <div class="container pb-25">
            <h3 class="section-title mb-20 wow fadeIn animated text-center"><span>Featured</span> Clients</h3>
            <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-1.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-2.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-3.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-4.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-5.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-6.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{ asset('/') }}assets/imgs/banner/brand-3.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
</main>
