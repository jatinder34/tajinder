<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--===================================================================================-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===================================================================================-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--===================================================================================-->
    <title>Tajinder</title>
    <!--===================================================================================-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--===================================================================================-->
    <!------ Include the above in your HEAD tag ---------->

    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!--===================================================================================-->
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!--===================================================================================-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--===================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!--===================================================================================-->
    <link href="{{URL::asset('/public/css/admin.css')}}" rel="stylesheet" type="text/css">
    <!--===================================================================================-->
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--===================================================================================-->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!--===================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <!--===================================================================================-->
    <!-- <script src="{{URL::asset('/public/js/admin.js')}}"></script> -->

</body>
</html>
