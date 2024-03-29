<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Dhilla Stuff">
    <meta name="keywords" content="Dhilla Stuff Aesthetic Stationery Shop">

    <meta property="og:description" content="Dhilla Stuff Aesthetic Stationery Shop">
    <meta property="og:image" content="{{ url('frontend/img/dhillastuff-logo.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Opsional: menentukan jenis konten -->
    <meta property="og:type" content="website">

    <!-- Opsional: menentukan situs web pembuat halaman -->
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.frontend.style')
    @stack('addon-style')
</head>

<body>




    @yield('content')



   @stack('prepend-script')
   @include('includes.frontend.script')
   @stack('addon-script')
</body>

</html>
