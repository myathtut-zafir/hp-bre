<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @routes
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset(mix('js/manifest.js')) }}" defer></script>
    <script src="{{ asset(mix('js/vendor.js')) }}" defer></script>
    <script src="{{ asset("js/app.js") }}"></script>
    @inertiaHead
    <style>
        .radio-container {
            background-color: #f0f0f0;
            border: 1px solid lightgray;
            transition: all 400ms;
        }
        .radio-container.checked {
            background-color: #ed1b34;
            border: 1px solid #ed1b34;
        }
        .radio-container.checked > label {
            color: white;
        }
    </style>
</head>
<body class="flex justify-center">
@inertia
</body>
</html>
