<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Ordering</title>
    @include('customers.particular.css')
    @yield('css')
</head>
<body>
    <div id="wrapper">
        @include('customers.particular.header')
        <div id="main">
            @yield('main')
        </div>
        @include('customers.particular.footer')
    </div>
    @include('customers.particular.js')
    @yield('js')
</body>
</html>
