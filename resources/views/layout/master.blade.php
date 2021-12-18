<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title' ,'No page')</title>
</head>
<body>
    @include('layout.navbar')
    @yield('contact')
    @yield('sidbar')
    @section('sidebar')
        This is side bar links of pages
        @show
    {{--   34an show here --}}
</body>
</html>