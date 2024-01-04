<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.frontend.style')
    @stack('addon-style')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('includes.frontend.navbar-frontend')

    @yield('content')
    {{-- @include('sweetalert::alert') --}}

    @include('includes.frontend.footer-frontend')

   @stack('prepend-script')
   @include('includes.frontend.script')
   @stack('addon-script')
</body>

</html>
