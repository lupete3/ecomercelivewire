{{-- <x-app-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout> --}}

<x-app-layout>
    <main class="main">
        <section class="pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5">
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                        </div>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="mb-4 text-sm text-gray-600">
                                                {{ __('Mot de passe oublié? Pas de problème. Laissez-nous juste votre adresse mail et nous vous envoyerons un lien de récupération et vous choisirez un nouveau mot de passe.') }}
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Votre Adresse Mail" value="{{ old('email') }}" required autofocus>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up w-100" name="login">Lien de récupération</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
