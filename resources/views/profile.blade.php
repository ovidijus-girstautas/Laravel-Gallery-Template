@extends('layouts.theme')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your image gallery</div>

                <div class="panel-body">

                    <a href="/posts/create" class="btn btn-success">Upload new Image</a>

                    <table class="table table-striped">
                    <tr>
                        <td class="col-lg-4">Thumbnail</td>
                        <td>Title</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <th><a href="/posts/{{$post->id}}"><img src="/storage/images/{{$post->image}}" class="img-thumbnail img-responsive hover" alt=""></a></th>
                            <th>{{$post->title}}</th>
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
