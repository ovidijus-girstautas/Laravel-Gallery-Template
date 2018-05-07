@extends('layouts.theme')

@section('content')
	<div class="container-fluid" style="display:flex;">
	<div class="row-fluid well">
		<div style="height:100%; " class="col-lg-8 row-fluid">
			<h3>About Me</h3>
			<p>{!!  $user->about!!}</p>
		</div>

		<div  class="col-lg-4 text-center">
			<h3>{{$user->name}}</h3>
			<img class="img-responsive" style='width: 100%; object-fit: contain' src="/storage/images/{{$user->avatar}}" alt="">
		</div>
	</div>
	</div>



	<h3><a class="col-lg-12 text-center" href="/userPosts/{{$user->id}}" style="text-decoration:none; margin-bottom: 10px;">Latest Uploads</a></h3>
	@foreach($posts as $post)
		<div class="col-md-3 col-sm-6 col-xs-6 gal-item image-gallery">
			<div class="">
				<a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a>
{{--				<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>--}}
			</div>
		</div>
	@endforeach
	<div class="container-fluid col-lg-12">
		@if(Auth::user()->id == $user->id)
			<a href="/userProfile/{{$user->id}}/edit" class="btn btn-danger pull-right" style="width: 120px">Edit Profile</a>
		@endif
	</div>




@endsection