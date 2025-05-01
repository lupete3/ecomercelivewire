<main class="main single-page">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow">{{ Lang::get('Home', [], $locale) }}</a>
                <span></span> {{ Lang::get('messages.about_us', [], $locale) }}

            </div>
        </div>
    </div>
    <section class="section-padding">
        <div class="container pt-25">
            <div class="row">
                <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                    <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">
                        {{ Lang::get('messages.about_us', [], $locale) }}
                    </h6>
                    <h1 class="font-heading mb-40">
                        {{ $about->title }}
                    </h1>
                    <p>{{ $about->description }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('admin/about/'.$about->image) }}" alt="">
                </div>
            </div>
        </div>
    </section>
</main>
