<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>recipe house</title>
    @vite('resources/css/app.css')
</head>
<html>
    <body class="ml-4 mt-4 font-serif">
        {{$slot}}
    </body>
</html>
{{-- <script src="{{ url('js/main.js') }}"></script> --}}
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>

