@extends('layouts.app')

@section('content')
<style>
	.icone img{
		width: 50%;
		max-width: 400px;
		margin:auto;
	}
	</style>
@if(Auth::user()->role == 'admin')	
<div class="d-flex justify-content-end mb-3"><a href="{{ route('formations.create') }}" class="btn btn-secondary">Ajouter une formation</a></div>
@endif
<div class="row justify-content-center mb-4"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>
<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach ($formations as $formation)
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
							@if($formation->isStarted == 1)
							<h6 class="card-subtitle mb-2 text-muted">Demarrage: OUI </h6>
							@else
							<h6 class="card-subtitle mb-2 text-muted">Demarrage: NON </h6>
							@endif
							@if(Auth::user()->role == 'candidat')
							@if (Auth::user()->formations->contains('id', $formation->id)) 
										<div class="row justify-content-center"><button  class="btn btn-dark btn-sm" type="">Candidature Lancée</button></div>
							@else
								<form action="{{ route('candidats.storeFormation', [Auth::user()->id]) }}" method="post">
									@csrf
									<select hidden name="formation_id">
											<option selected value="{{ $formation->id }}">{{ $formation->nom }}</option>
									</select>
									<div class="row justify-content-center"><button  class="btn btn-outline-dark btn-sm" type="submit">Postuler</button></div>
								</form>
								@endif
							@else
							<div class="d-flex gap-2">
								<a href="{{ route('formations.show', [$formation->id]) }}" class="btn btn-outline-dark">Referentiels</a>
								<a href="{{ route('formations.edit', [$formation->id]) }}" class="btn btn-outline-warning">Modifier</a>
								{!! Form::open(['method' => 'DELETE','route' => ['formations.destroy', $formation->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger']) !!}
								{!! Form::close() !!}
							</div>
							@endif
						</div>
						</div>
					</div>
				@endforeach
		
</div>

@stop
