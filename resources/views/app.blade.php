<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_QtrwO_i4phf9Ym1Wh3tdX3MH1StWxXU&libraries=&v=weekly"
        defer></script> --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html>
