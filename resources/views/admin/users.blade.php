@extends('layouts.theme')

@section('content')
	<div class="panel panel-default">

	<table class="table table-striped">

		<tr>
			<td class="col-lg-4">Username</td>
			<td>Email</td>
			<td>Action</td>
		</tr>
		@foreach($users as $user)
			<tr >
				<th>{{$user->name}}</th>
				<th>{{$user->email}}</th>
				<th>
					@if($user->is_admin == true)
						<a class="btn btn-default" href="/userProfile/{{$user->name}}" style="width: 120px; background-color: red; color: white;">ADMIN</a>
					@elseif($user->isBanned == false)
						{!! Form::open(['action' => ['AdminController@ban', $user->id], 'method' => 'POST']) !!}
						{{Form::hidden('isBanned', 1)}}
						{{Form::hidden('_method', 'PUT')}}
						{{Form::submit('Ban User', ['class' => 'btn btn-danger', 'style' => 'width: 120px'])}}
						{!! Form::close() !!}
					@else
						{!! Form::open(['action' => ['AdminController@unban', $user->id], 'method' => 'POST']) !!}
						{{Form::hidden('isBanned', 0)}}
						{{Form::hidden('_method', 'PUT')}}
						{{Form::submit('Remove Ban', ['class' => 'btn btn-success','style' => 'width: 120px'])}}
						{!! Form::close() !!}
					@endif
				</th>
			</tr>
		@endforeach
	</table>
	</div>
@endsection
