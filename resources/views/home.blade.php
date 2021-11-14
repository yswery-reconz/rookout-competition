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
        <img class="d-block mx-auto" src="{{ asset('images/rookout_logo_icon_170773.png') }}" alt="" width="300" height="150">
        <h2>First ever debugging competition</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
                <div class="card-body">
                    <h5 class="card-title">How it works</h5>
                    <p class="card-text">

                    <div class="row">
                        <div class="col-8">
                            <ol>
                                <li>Sign up a new account at <a href="https://app.rookout.com" target="_blank">https://app.rookout.com</a></li>
                                <li>Scan the QR Code or <a href="#">click here</a> to get into the competition</li>
                                <li>You will need to debug our project application to find a secret token in order to stop the clock</li>
                                <li>Dont worry, clues will be given to you along the way</li>
                                <li>Once you are ready with you Rookout account, click Start Debugging to start the clock</li>
                            </ol>
                        </div>
                        <div class="col-4">
                            <img class="float-right" width="100" height="100" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAABlBMVEX///8AAABVwtN+AAACjElEQVR4nO3dS47bQAwE0Jn7XzqrAAEit1hFGcYkj8s2P/V0AX997+rrd0U9X3/V5Kcy4Xae8LKHkDBKuJ0nvOwhJIwSHlYfqssafY5o4WmK8G6+CkQYLzxNEd7NV4EI44WnKcK7+SrQh4WT893Vw3h0K0tISEhISEhI+Jxw+RUICQkJCQkJf5bwAHvqJ0JCQkJCQsK9cFKROdo8uZVNEU6vEvZFeDdFOL1K2Bfh3dT3rpbm6KVMuJ0nfPClTLidJ3zwpUy4nSd88KVMuJ0nfPBlmXBb0eoJ47FkTxXhdXM3/pkivG7uxj9ThNfN3fhnivC6uRsvky0DTSI+1RyNExISEhISEl66Jp7Joqh5Ul2M06LlasK4CAknyQinewpeHeO0aLmaMK5SGEWcHIv2PMUgJIxyZOeTzYSE3U+Ed+eTzYR3Jw4bu6tdT/TtDuOEhISEhISEf05NYNHG5XhkHn0OQkJCQkJCwjD0af71wslL91OUh5CQkJCQkLBONtnTVZmekJCQkJCQ8Dnh4wsf/4jbQFER9kcJF4GiIuyPEi4CRUXYHy2F74s4yXEIfRjfUgkJCQkJCQlnFa2O0h/GlzGyIrxpJrweX8bIivCmmfB6fBkjK8Kb5jcKJ8cmOSYv0ZeavBzynNCEhISEhIT/sXCZY5n1jZsJCQkJCQkJ3/B/wFGg6Ho0lZ0nJCQkJCQknAmj9JOpSYzRFyckJCQkJCR8p7BLP7kefVbCF2OHq9HCqAhfNEeBCAl3RfiiOQr0jwgntby6PHpYSJgfWwbqjhISRseWgbqjhITRsWWg7mgp7OoQOsoxaS4TbucJL1+65jLhdp7w8qVrLhNu5wkvX7rmMuF2nvDypWvu6hdwJWEkXvHKCAAAAABJRU5ErkJggg==" />
                        </div>


                    </div>

                    @if ($user->start_time)
                        <hr />
                        <h5>First Clue!</h5>

                        <p>
                            Your first clue is to head over to Rookout and set a break point on line  <strong color="red">{{ $user->debug_events()->where('stage', 1)->first()->line_number }}</strong> in file <strong color="red">{{ $user->debug_events()->where('stage', 1)->first()->file_path }}</strong>
                        </p>

                        <hr />
                        <form action="{{ route('stop') }}" method="POST">
                            <div class="form-group">
                                <input type="text" name="token" class="form-control @error('token') is-invalid @enderror" id="token" aria-describedby="tokenHelp" placeholder="Secret Token" required>
                                @error('token')
                                    <div id="tokenHelp" class="invalid-feedback">
                                        Token is incorrect, please try again!
                                    </div>
                                @enderror
                                <small id="tokenHelp" class="form-text text-muted">Once you have found the secret token, submit it here to stop the clock.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Stop The Clock</button>
                        </form>
                    @else
                        <a href="{{ route('start') }}" class="start btn btn-primary">Start Debugging!</a>
                    @endif


                </div>

                <div class="d-none card-footer text-muted elapsed-time text-center" data-seconds="{{ $user->start_time ? time() - $user->start_time + 1 : 0 }}">

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>