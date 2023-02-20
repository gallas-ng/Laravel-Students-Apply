@extends('layouts.app')

@section('content')
<div class="row " style="display: flex; align-items: center; justify-content: center;">
<div class="card  col-md-6 ">

	@if($errors->any())
	<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			{{ $error }} <br>
			@endforeach
		</div>
		@endif
		<div class="card-header"> Ajout de Type</div>
		{!! Form::open(['route' => 'types.store']) !!}
		<div class="card-body">
			<div class="mb-3">
				
				{{ Form::label('libelle', 'Libelle', ['class'=>'form-label']) }}
				{{ Form::text('libelle', null, array('class' => 'form-control')) }}
			</div>
			<div class="mb-3  justify-content-center">
	
				{{ Form::submit('Create', array('class' => 'btn btn-outline-dark')) }}
			</div>
		</div>


	{{ Form::close() }}
	
	
</div>
</div>
	@stop