<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Betta Breeder') }}</title>

    {{-- script --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head> 
<body id="app">

</body>
</html>