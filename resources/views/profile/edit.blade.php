@extends('layouts.theme')

@section('content')
	<h1>Edit Profile</h1>
	{!! Form::open(['action' => ['UserProfileController@update', $posts->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

	<div class="form-group">
		{{Form::label('about', 'About')}}
		{{Form::textarea('about', $posts->about, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Description'])}}
	</div>
	<div class="form-group">
		{{Form::file('avatar')}}
	</div>

	{{Form::hidden('_method', 'PUT')}}
	{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}

@endsection