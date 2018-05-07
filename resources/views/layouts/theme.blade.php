<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name', 'Project')}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://use.fontawesome.com/812f6b5698.js"></script>


</head>
<body>
    @include('includes.navbar')
    <div class="container">
        @include('includes.msg')
        @yield('content')
    </div>
    {{--@include('includes.footer')--}}



    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>

</html>
