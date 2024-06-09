<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('images/fav.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    {{-- CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Inter;
            background-color: #f8f9fa;
        }
        footer h5{
            color: #FF9C27;
            font-weight: bold;
        }
        footer p {
            color: white;
        }
        .liColor{
            color:white;
        }
        div.bottomRight{
            display: block;
            position: absolute;
            bottom: 0;
            right: 0;
        }
    </style>

</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    <div class="col-md-3 me-5">
                        <a class="justify-content-start" href="{{ route('welcome') }}">
                            <img src="{{url('images/logo.png')}}" width="100%">
                        </a>
                    </div>
                    <div class="dropdown mt-3 me-3">
                        <a class="btn btn-secondary" style="background-color: transparent; color: black; border: 0;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                          Categories
                        </a>
                      
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @php
                                $categoriesNav = getCategoriesNav();
                                $categoriesFoot = getCategoriesFooter();
                            @endphp
                            @foreach ($categoriesNav as $category)
                                <li><a class="dropdown-item" href="{{ route('users.category', $category->id) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ url('search') }}" method="GET" role="search">
                        <div class="input-group mt-3 ms-2">
                            <input type="search" name="search" value="" class="form-control" style="border-radius: 20px 0 0 20px; border-style: solid hidden solid solid; border-color: grey">
                            <button class="btn btn-outline-secondary " type="submit" style="border-radius: 0 20px 20px 0; border-style: solid solid solid hidden;">
                                <i class="fa fa-search"></i>
                            </button>                        
                        </div>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item p-2">
                                <a class="btn btn-primary fs-6 ms-2" role="button" href="{{ route('login') }}" style="background-color: #FF9C27; border-color: #FF9C27"><b>{{ __('LOGIN') }}</b></a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item p-2">
                                <a class="btn btn-primary fs-6" href="{{ route('register') }}" style="background-color: transparent; border-color: #0687B0; color: #0687B0"><b>{{ __('REGISTER') }}</b></a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (auth()->user()->type == "admin")
                                    <a class="dropdown-item" href="{{ route('admins.dashboard') }}">Dashboard</a>
                                @elseif (auth()->user()->type == "lecturer")
                                    <a class="dropdown-item" href="{{ route('lecturers.dashboard') }}">Dashboard</a>
                                @else
                                    
                                @endif
                                <a class="dropdown-item" href="/chatify">Chat</a>
                                <a class="dropdown-item" href="{{ route('users.settings.profile.edit') }}">Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 d-flex align-items-center">
        @yield('content')
    </main>

    <footer class="container-fluid justify-content-center d-flex mt-auto" style="background-color: #464849;">
        <div class="container row row-cols-1 row-cols-sm-2 row-cols-md-5 py-4 my-4 border-top">
            <div class="col me-5">
                <h5>Abouts EduLab</h5>
                <p class="fs-6">Our mission is to provide a free and world class eduction to anyone and everywhere around the world.</p>
                <p class="fs-6">&copy; 2022 The EduLab</p>
            </div>
        
            @guest

            @else
                @if (auth()->user()->type == 'student')
                    <div class="col ms-5">
                        <h5>For Students</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="{{ route('users.settings.profile.edit') }}" class="nav-link p-0 liColor">My Account</a></li>
                            <li class="nav-item mb-2"><a href="{{ route('users.getEnrolled') }}" class="nav-link p-0 liColor">My Learning</a></li>
                        </ul>
                    </div>
                @endif
            @endguest
        
            <div class="col ms-5">
                <h5>Courses</h5>
                <ul class="nav flex-column">
                    @foreach ($categoriesFoot as $category)
                        <li class="nav-item mb-2"><a href="{{ route('users.category', $category->id) }}" class="nav-link p-0 liColor">{{ $category->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        
            <div class="col">
                <h5>More</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('users.terms') }}" class="nav-link p-0 liColor">Terms and Conditions</a></li>
                    <li class="nav-item"><a href="{{ route('users.privacy') }}" class="nav-link p-0 liColor">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
