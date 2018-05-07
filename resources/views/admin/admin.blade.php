@extends('layouts.theme')

@section('content')

	<nav>
		<ul class="admin-panel-ul" style="display: flex; justify-content: space-around">
			<li class="admin-panel-li">
				<div class="front admin-panel-div" id="box1"><i class="fa fa-envelope-o fa-2x"> </i></div>
				<div class="back admin-panel-div">
					<a class="admin-panel-a" href="/admin/posts">EDIT POSTS</a>
				</div>
			</li>

			<li class="admin-panel-li">
				<div class="front admin-panel-div" id="box2"><i class="fa fa-newspaper-o fa-2x"></i></div>
				<div class="back admin-panel-div">
					<a class="admin-panel-a" href="/admin/news">SITE NEWS</a>
				</div>
			</li>

			<li class="admin-panel-li">
				<div class="front admin-panel-div" id="box3"><i class="fa fa-users fa-2x"></i></div>
				<div class="back admin-panel-div">
					<a class="admin-panel-a" href="/admin/users">USERS</a>
				</div>
			</li>
		</ul>
	</nav>
@endsection
