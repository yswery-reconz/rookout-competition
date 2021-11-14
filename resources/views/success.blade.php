<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-3 text-center">
        <img class="d-block mx-auto" src="{{ asset('images/rookout_logo_icon_170773.png') }}" alt="" width="400" height="200">
        <h2>Success! You found the correct token!</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">Good work!</h5>
                    <p class="card-text">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum..
                    </p>

                    Check out the current <a href="{{ route('leaderboard') }}">leader board to see where you ranked</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>