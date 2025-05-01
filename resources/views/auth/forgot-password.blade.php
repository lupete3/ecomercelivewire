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
                                            <h3 class="mb-30">{{ Lang::get('messages.forgot_password_title', [], $locale) }}</h3>
                                        </div>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="mb-4 text-sm text-gray-600">
                                                {{ Lang::get('messages.forgot_password_description', [], $locale) }}
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="{{ Lang::get('messages.email', [], $locale) }}" value="{{ old('email') }}" required autofocus>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up w-100" name="login">
                                                    {{ Lang::get('messages.reset_password_link', [], $locale) }}
                                                </button>
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
