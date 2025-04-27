{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.app')

@section('content')
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
                                            <h3 class="mb-30">Connexion</h3>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="phone_email" placeholder="Votre Adresse Mail ou Téléphone" value="{{ old('phone_email') }}" required autofocus>
                                                <x-input-error :messages="$errors->get('phone_email')" class="mt-2 text-danger" />
                                            </div>
                                            <style>
                                                .password-toggle-icon {
                                                    position: absolute;
                                                    right: 10px;
                                                    top: 50%;
                                                    transform: translateY(-50%);
                                                    cursor: pointer;
                                                    color: #6c757d;
                                                }
                                                .password-toggle-icon:hover {
                                                    color: #343a40;
                                                }
                                            </style>
                                            <div class="form-group position-relative">
                                                <input required="" type="password" name="password" id="password" placeholder="Mot de passe" class="pr-4">
                                                <span class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                                    <i class="fi-rs-eye"></i>
                                                </span>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Se souvenir de moi</span></label>
                                                    </div>
                                                </div>

                                                @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">Mot de pass oublié?</a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Connexion</button>
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
@endsection

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.password-toggle-icon i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fi-rs-eye');
            icon.classList.add('fi-rs-eye-crossed');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fi-rs-eye-crossed');
            icon.classList.add('fi-rs-eye');
        }
    }
</script>
