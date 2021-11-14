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
        <h2>Current Leaderboard</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="leaderboard" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Time Taken</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $position => $user)
                    <tr>
                        <td>{{ $position + 1 }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->time_taken }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>