@extends('layouts.app')

@section('content')
    @php
        $locale = session('locale', config('app.locale'));
    @endphp
    <main class="main">
        <section class="pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">{{ Lang::get('messages.create_account', [], $locale) }}</h3>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="{{ Lang::get('messages.name', [], $locale) }}" value="{{ old('name') }}" required autofocus>
                                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input type="number" required="" name="phone" placeholder="{{ Lang::get('messages.phone', [], $locale) }}" value="{{ old('phone') }}" required>
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required="" name="email" placeholder="{{ Lang::get('messages.email', [], $locale) }}" value="{{ old('email') }}" required>
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
                                                <input required="" type="password" name="password" id="password" placeholder="{{ Lang::get('messages.password', [], $locale) }}" class="pr-4">
                                                <span class="password-toggle-icon" onclick="togglePasswordVisibility()">
                                                    <i class="fi-rs-eye"></i>
                                                </span>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" placeholder="{{ Lang::get('messages.confirm_password', [], $locale) }}" required>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12">
                                                            <span>{{ Lang::get('messages.accept_terms', [], $locale) }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <a href="privacy-policy.html">
                                                    <i class="fi-rs-book-alt mr-5 text-muted"></i>{{ Lang::get('messages.learn_more', [], $locale) }}
                                                </a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">
                                                    {{ Lang::get('messages.register_button', [], $locale) }}
                                                </button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">
                                            {{ Lang::get('messages.already_have_account', [], $locale) }}
                                            <a href="{{ route('login') }}">{{ Lang::get('messages.login_now', [], $locale) }}</a>
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
