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
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Créer un compte</h3>
                                        </div>                                        
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="Nom" value="{{ old('name') }}" required autofocus>
                                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required="" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Mot de passe" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>Accepter les termes &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>En savoir plus</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Enregistrer</button>
                                            </div>
                                        </form>                                        
                                        <div class="text-muted text-center">Avez-vous déjà un compte? <a href="{{ route('login') }}">Se connecter maintenant</a></div>
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
