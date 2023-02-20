@extends('layouts.app')

@section('content')

@if(Auth::user()->role == 'admin')
<div class="d-flex justify-content-end mb-3"><a href="{{ route('types.create') }}" class="btn btn-secondary">Create</a></div>
@endif
<div class="row justify-content-center mb-4"><a  class="btn btn-outline-secondary btn-sm" type="" href="{{ url('/home') }}">Acceuil</a></div>

	<div class="row justify-content-center mb-4 " style="width: 100%;">
				@foreach ($types as $type)
					<div class="col-lg-4 col-md-6">
						<div class="card" style="width: 100%;">
						<div class="icone">
						</div>
						<div class="card-body">
							<h5 class="card-title">  {{ $type->libelle }}</h5>
							@if(Auth::user()->role != 'candidat')
							<div class="d-flex gap-2">
								<a href="{{ route('types.edit', [$type->id]) }}" class="btn btn-dark">Edit</a>
								{!! Form::open(['method' => 'DELETE','route' => ['types.destroy', $type->id]]) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
								{!! Form::close() !!}
							</div>
							@endif
						</div>
						</div>
					</div>
				@endforeach
		
</div>

	
@stop
