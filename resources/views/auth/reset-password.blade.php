{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}

<x-app-layout>
    <main class="main">
        <section class="pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset('assets/imgs/login.png') }}">
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-5">
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                        </div>
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf
                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Votre Adresse Mail" value="{{ old('email', $request->email) }}" required autofocus>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
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
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le Mot de passe" class="pr-4">

                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up w-100" name="login">Restaurer le mot de passe</button>
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
