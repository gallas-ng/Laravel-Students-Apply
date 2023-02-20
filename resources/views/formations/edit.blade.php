@extends('layouts.app')

@section('content')
<div class="row mb-5" style="display: flex; align-items: center; justify-content: center;">
<div class="card  col-md-6 ">

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	<div class="card-header"> Modifier une formation</div>
		{{ Form::model($formation, array('route' => array('formations.update', $formation->id), 'method' => 'PUT')) }}
		<div class="card-body">
		<div class="mb-3">
			{{ Form::label('nom', 'Nom', ['class'=>'form-label']) }}
			{{ Form::text('nom', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('duree', 'Duree (mois)', ['class'=>'form-label']) }}
			{{ Form::number('duree', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('description', 'Description', ['class'=>'form-label']) }}
			{{ Form::textarea('description', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('isStarted', 'Statut des formations', ['class' => 'form-label']) }}
			<div class="ml-4">
				<label class="form-check-label mr-3">
					{{ Form::radio('isStarted', 1, false, ['class' => 'form-check-input']) }}
					Démarrée
				</label>
				<label class="form-check-label">
					{{ Form::radio('isStarted', 0, true, ['class' => 'form-check-input']) }}
					Non démarrée
				</label>
			</div>
		</div>
		<div class="mb-3">
			{{ Form::label('dateDebut', 'DateDebut', ['class'=>'form-label']) }}
			{{ Form::date('dateDebut', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-dark')) }}
	</div>
	{{ Form::close() }}
</div>

</div>
</div>
@stop
