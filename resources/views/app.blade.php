<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">

    <script src="{{ mix('dist/js/manifest.js') }}" defer></script>
    <script src="{{ mix('dist/js/vendor.js') }}" defer></script>
    <script src="{{ mix('dist/js/app.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html>
