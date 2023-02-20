@extends('layouts.app')

@section('content')
<style>
    .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
	.icone img{
		width: 50%;
		max-width: 400px;
		margin:auto;
	}

</style>


	<div class="container">
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
					<div class="row justify-content-center"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>
                    </div>
    
        <div class="col-md-8 mb-12">
			<div class="card">
					<div class="card-header"><h3>Mes Candidatures</h3></div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
					</div>
			
			<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach ($candidat->formations as $formation)
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
						<div class="icone">
						<img id="icone" src="https://img.freepik.com/icones-gratuites/ligne_318-717717.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=ais" class="card-img-top" alt="card-img-top">
						</div>
						<div class="card-body">
							<h5 class="card-title">  {{ $formation->nom }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Duree: {{ $formation->duree }} mois</h6>
							<p class="card-text">  {{ $formation->description }}</p>
							<h6 class="card-subtitle mb-2 text-muted">Date debut: {{ $formation->dateDebut }} </h6>
							<a href="{{ route('formations.show', [$formation->id]) }}" class="btn btn-secondary mb-2">Voir les referentiels</a>
							<form action="{{ route('candidats.removeFormation', [Auth::user()->id]) }}" method="post">
									@csrf
									<select hidden name="formation_id">
											<option selected value="{{ $formation->id }}">{{ $formation->nom }}</option>
									</select>
									<button href="" type="submit" class="btn btn-danger ">Se desinscrire</button>
							</form>
						</div>
						</div>
					</div>
				@endforeach
		
            </div>
			</div>
		</div>
	</div>
	

@endsection