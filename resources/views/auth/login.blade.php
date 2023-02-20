@extends('layouts.app')

@section('content')
<style>

    .presentation-img img{
        
        width: 100%;
        max-width: 400px;
        margin:auto;
        top: 5px;
        transform: scale(1.0);
    }
</style>
<div class="container">
    <div class="text text-center" style="font-size: Large;" > ! Veuillez renseigner vos identifiants pour vous connecter. </div>
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="presentation-img">
                        <img src="https://img.freepik.com/vecteurs-premium/illustration-vectorielle-concept-abstrait-confidentialite-donnees_107173-28145.jpg?w=740" alt="Image de programmation">
                        </div>
                    </div>
                    <div class="col-md-6">
            <div class="card">
                <div class="card-header">  Connexion</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mot de Passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
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
@endsection
