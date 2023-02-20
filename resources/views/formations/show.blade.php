@extends('layouts.app')

@section('content')
<style>
	.icone img{
		width: 50%;
		max-width: 400px;
		margin:auto;
	}
	.presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>
	<div class="container">
			<div class="row align-items-center   ">
                    <div class="col-md-3">
                        <div class="card">
                        <div class="presentation-img mb-2 center ">  
						<img id="icone" src="https://img.freepik.com/icones-gratuites/ligne_318-717717.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=ais" class="card-img-top" alt="card-img-top">
                        </div>
                        <div class="card-header">
                        <h4 id="" class="text-align-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Formation :    {{ $formation->nom }}
                        </h4>
                        </div>
                    </div>
					<div class="row justify-content-center"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>
                    </div>
    
        <div class="col-md-8 mb-12">
			<div class="card">
					<div class="card-header"><h3>Referentiels</h3></div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
					</div>
			
			<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach ($formation->referentiels as $referentiel)
				<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
						<div class="icone">
						<img id="icone" src="https://img.freepik.com/icones-gratuites/apprentissage_318-599759.jpg?size=626&ext=jpg&ga=GA1.2.938414909.1676740287&semt=ais" class="card-img-top" alt="card-img-top">
						</div>
						<div class="card-body">
							<h5 class="card-title">  {{ $referentiel->libelle }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Horaire: {{ $referentiel->horaire }} H</h6>
			
						</div>
						</div>
					</div>
				@endforeach
		
            </div>
			</div>
		</div>
	</div>
	@if(Auth::user()->role == 'admin')
	<div class="container mt-4 display-flex align-items-center">
			
		<div class="card mb-3 mt-4 col-md-6">
			<div class="card-header "><h3>Ajouter un referentiel</h3></div>
			<div class="card-body">
			<form action="{{ route('formations.storeReferentiel', [$formation->id]) }}" method="post">
				@csrf
				<select class="form-select form-select-lg mb-3" name="referentiel_id">
					@foreach ($referentiele as $referentiel)
						<option value="{{ $referentiel->id }}">{{ $referentiel->libelle }}</option>
					@endforeach
				</select>
				<button type="submit" class="btn btn-dark btn-">Ajouter</button>
			</form>
			</div>
		</div>
	</div>
	@endif
@stop