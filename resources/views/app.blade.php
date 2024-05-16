<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>

    <link
        href="https://fonts.googleapis.com/css?family=Poetsen+One:100,100i,300,300i,400,400i,500,500i,600,600i,700,700i,900,900i&display=swap"
        rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"
        rel="stylesheet" type="text/css">

    @inertiaHead
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
@inertia
</body>
</html>
