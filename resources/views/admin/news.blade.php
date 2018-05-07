@extends('layouts.theme')

@section('content')
	<div class="col-lg-12">
		<a href="/admin/create" class="pull-right btn btn-success" >ADD NEWS POST</a>
		<br>
		<h1 class="display-3"></h1>
		@foreach($news as $new)
			<div class="well">
				<h1 class="display-3">{{$new->title}}</h1>
				<small class="orange">Uploaded at {{$new->created_at}}</small>
				<th><a href="/admin/{{$new->id}}/edit" class="btn btn-warning pull-right"> Edit </a></th>

				{!!Form::open(['action' => ['AdminController@destroy', $new->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
				{!!Form::close()!!}
			</div>
		@endforeach
	</div>
@endsection
