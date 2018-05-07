@extends('layouts.theme')

@section('content')
	<div class="well col-lg-12">
	<h1>{{$news->title}}</h1>
	<img src="/storage/images/{{$news->image}}" class="img-thumbnail img-responsive" alt="">
	</div>
	<div class="col-lg-12 jumbotron padding" style="height: 100%;">
		<h5>{!! $news->desc!!}</h5>
	</div>

@endsection