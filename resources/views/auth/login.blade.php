@extends('layouts.app')

@section('content')
    <main class="main">
        @php
            $locale = session('locale', config('app.locale'));
        @endphp
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
                                            <h3 class="mb-30">{{ Lang::get('messages.login', [], $locale) }}</h3>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="phone_email" placeholder="{{ Lang::get('messages.email_or_phone', [], $locale) }}" value="{{ old('phone_email') }}" required autofocus>
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
                                                <input required="" type="password" name="password" id="password" placeholder="{{ Lang::get('messages.password', [], $locale) }}" class="pr-4">
                                                <span class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                                    <i class="fi-rs-eye"></i>
                                                </span>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1">
                                                            <span>{{ Lang::get('messages.remember_me', [], $locale) }}</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">
                                                        {{ Lang::get('messages.forgot_password', [], $locale) }}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">
                                                    {{ Lang::get('messages.login_button', [], $locale) }}
                                                </button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">
                                            {{ Lang::get('messages.dont_have_account', [], $locale) }}
                                            <a href="{{ route('register') }}">{{ Lang::get('messages.register_now', [], $locale) }}</a>
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
