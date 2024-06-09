<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('./images/fav.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    {{-- CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('styles')
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter';
        }
        .background{
            background-image: url('../images/auth.jpg');
            height: 100%;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

</head>
<body>
    <main class="py-4 background d-flex align-items-center">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card p-5 w-100 m-auto">

                        <div class="ms-3 me-3">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div style="margin-left:-1%">
                                <h2 class="mb-3 ms-1" style="color: #009DA6;"><b>FORGOT PASSWORD?</b></h2>
                                <p class="mb-3 ms-1">Enter your email to get a password reset link</p>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-form-label mb-2">{{ __('Email Address') }}</label>

                                    <div>
                                        <input id="email" type="email" class="form-control mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row ms-2 me-2">
                                        <button type="submit" class="btn btn-primary fs-5" style="background-color: #009DA6;">
                                            <b>{{ __('Send Password Reset Link') }}</b>
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>