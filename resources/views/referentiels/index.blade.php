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
	<div class="d-flex justify-content-end mb-3"><a href="{{ route('referentiels.create') }}" class="btn btn-secondary">Create</a></div>
@endif
<div class="row justify-content-center mb-4"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>

	<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach ($referentiels as $referentiel)
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
						<div class="icone">
						<img id="icone" src="https://img.freepik.com/icones-gratuites/apprentissage_318-599759.jpg?size=626&ext=jpg&ga=GA1.2.938414909.1676740287&semt=ais" class="card-img-top" alt="card-img-top">
						</div>
						<div class="card-body">
							<h5 class="card-title">  {{ $referentiel->libelle }}</h5>
							<h6 class="card-subtitle mb-2 text-muted">Horaire: {{ $referentiel->horaire }} H</h6>
							@if($referentiel->validated == 1)
							<h6 class="card-subtitle mb-2 text-muted">Validated: OUI </h6>
							@else
							<h6 class="card-subtitle mb-2 text-muted">Validated: NON </h6>
							@endif
							@foreach($types as $type)
							@if($type->id == $referentiel->type_id)
							<p class="card-text"> {{ $type->libelle}} </p>
							<td> </td>
							@endif
							@endforeach
							@if(Auth::user()->role != 'candidat')
							<div class="d-flex gap-2">
								<a href="{{ route('referentiels.edit', [$referentiel->id]) }}" class="btn btn-outline-dark">Modifier</a>
								{!! Form::open(['method' => 'DELETE','route' => ['referentiels.destroy', $referentiel->id]]) !!}
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
