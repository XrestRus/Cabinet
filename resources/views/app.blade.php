<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Cabinet</title>
       
        <link rel="shortcut icon" href="https://u108869.test-handyhost.ru/images/cabinet.svg" type="image/x-icon">
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <meta name="description" content="Личный кабинет предприятия"> 
        <meta name="Keywords" content="кабинет, ваш"> 
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia    
    </body>
</html>
