<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Challenge - Homepage</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <section id="app">
        <navbar-component></navbar-component>
        <search-component></search-component>
    </section>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
