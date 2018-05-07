@extends('layouts.theme')

@section('content')
	<div class="container">
		<div class="row">
			<h3>Manage Posts</h3>
			<div class="col-md-12 ">
				<div class="panel panel-default">
					<div class="panel-body">

						<table class="table table-striped">
							<tr>
								<td class="col-lg-1">Thumbnail</td>
								<td>Title</td>
								<td>User</td>
								<td></td>
								<td></td>
							</tr>
							@foreach($posts as $post)
								<tr>
									<th><a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a></th>
									<th>{{$post->title}}</th>
									<th><a href="/userProfile/{{$post->user->name}}">{{$post->user->name}}</th>
									<th><a href="/posts/{{$post->id}}/edit" class="btn btn-default"> Edit </a></th>
									<th>
										{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
										{{Form::hidden('_method', 'DELETE')}}
										{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
										{!!Form::close()!!}
									</th>
								</tr>
							@endforeach
						</table>


					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
