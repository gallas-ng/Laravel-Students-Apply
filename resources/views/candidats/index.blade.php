@extends('layouts.app')

@section('content')
<style>
	 .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>
<div class="row justify-content-center mb-4"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>
<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach($candidats as $candidat)
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
						<div class="presentation-img mb-2 center ">
						@if($candidat->sexe == 'feminin')    
                        <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/athlete_318-911222.jpg?size=626&ext=jpg" alt="Image de programmation">
                        @endif
                        @if($candidat->sexe == 'masculin')    
                        <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/agriculteur_318-911213.jpg?size=626&ext=jpg" alt="Image de programmation">
                        @endif
					    </div>
						<div class="card-body">
							<h5 class="card-title">  {{ $candidat->name }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Age: {{ $candidat->age }} ans</h6>
							<h6 class="card-subtitle mb-2 text-muted">Email: {{ $candidat->email }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Niveau d'Etude: {{ $candidat->niveau_etude }} </h6>
							<h6 class="card-subtitle mb-2 text-muted">Genre: {{ $candidat->sexe }} </h6>
						</div>
						</div>
					</div>
				@endforeach
		
</div>

@stop
