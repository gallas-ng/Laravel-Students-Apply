@extends('layouts.app')

@section('content')
<style>
    .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>
<div class="container ">
    <div class="row align-items-center   ">
                    <div class="col-md-3">
                        <div class="card">
                        <div class="presentation-img mb-2 center ">
                        @if(Auth::user()->role == 'candidat' && Auth::user()->sexe == 'feminin')    
                        <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/athlete_318-911222.jpg?size=626&ext=jpg" alt="Image de programmation">
                        @endif
                        @if(Auth::user()->role == 'candidat' && Auth::user()->sexe == 'masculin')    
                        <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/agriculteur_318-911213.jpg?size=626&ext=jpg" alt="Image de programmation">
                        @endif
                        @if(Auth::user()->role == 'admin')    
                        <img class="img-center mt-1" src="https://cdn-icons-png.flaticon.com/512/1226/1226073.png?w=740&t=st=1676769728~exp=1676770328~hmac=13ec0f9a836b28be0e44ef0beb1db33a73362e52633e1c5a5136f502a4d6f156" alt="Image de programmation">
                        @endif
                        </div>
                        <div class="card-header">
                        <h4 id="" class="text-align-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Utilisateur :        {{ Auth::user()->name }}
                        </h4>
                        </div>
                    </div>
                    </div>
    
        <div class="col-md-8 mb-12">
            <div class="card">
                <div class="card-header">Acceuil</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->role == 'admin')
                    Bienvenue sur l'interface administrateur de Tech_Booster
                    @else
                    Bienvenue sur votre site de Candidature Tech_Booster
                    @endif
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
                @if(Auth::user()->role == 'candidat')
                <div class="col-lg-4 col-md-6">
                    <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Candidatures</h5>
                        <p class="card-text">Aviez vous deja postuler ! Verifier vos candidatures .</p>
                        <a href="{{ route('candidats.show', [ Auth::user()->id]) }}" class="card-link">Voir ---></a>
                        
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Programmes</h5>
                        <p class="card-text">Venez decouvrir nos formations.</p>
                        <a href="{{ route('formations.index')}}" class="card-link">Voir ---></a>
                    </div>
                    </div>
                </div>
                @endif
                @if(Auth::user()->role == 'admin')
                                <div class="col-md-6 mt-3">
                                    <div class="card">
                                    <div class="presentation-img mb-2 center ">
                                    <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/barres_318-354011.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=ais" alt="Image de programmation">
                                    </div>
                                    <div class="card-header " >
                                        <h4 id="" class="text-align-center"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <a href="{{ route('c-p-f')}}" style="color: black;">
                                                Dashboard ->     
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                </div>
                @endif
            </div>
        

            </div>
        </div>
    </div>
    
        
    </div>
    <!--/ service_area_start  -->
               
    
@endsection
