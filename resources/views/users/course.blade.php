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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    {{-- CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('styles')
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Inter;
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
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>

</head>
<body>
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

    <main class="pb-3" style="background-color: #f8f9fa; margin-top: -1%">
        <div class="container-fluid" style="background-color:#464849">
            <div class="py-4 my-3 container d-flex">
                <div class="col-md-9 mt-4" style="color: white">
                    <h3 class="mb-5"><b>{{ $course->title }}</b></h3>
                    <p class="mb-2">Created by {{ $course->instructor->name }}</p>
                    <span>Last Updated: {{ $course->updated_at }}</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-globe"></i></i>
                        English
                </div>
                <div class="col-md-4 mt-3">
                    @if (empty($course->course_image))
                        <img src="https://via.placeholder.com/150x150" class="mb-4" width="300" height="150">
                    @else 
                        <img src="{{ asset('storage/course_images/'.$course->course_image) }}" class="mb-4 bg-light" width="300" height="150">
                    @endif
                    
                    @guest
                        
                    @else
                        @if (auth()->user()->type == 'student')
                            <div class="d-flex justify-content-center col-md-10">
                                <form action='{{ route('users.enrollment') }}' method='POST'>
                                    @method('POST')
                                    @csrf
                                    <input name='course_id' type='hidden' value='{{ $course->id }}'>
                                    <input name='student_id' type='hidden' value='{{ Auth::user()->id }}'>
                                    @if (empty($eRecord))
                                        <button class='btn btn-primary rounded-pill me-3' type='submit' style="background-color:#009DA6; border-color:#009DA6;">
                                            Enrol Now
                                        </button>
                                    @else
                                        <span class="btn btn-primary rounded-pill me-3" style="background-color:#009DA6; border-color:#009DA6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                            </svg>
                                            Enrolled
                                        </span>
                                    @endif
                                </form>
                                <form action='{{ route('users.watchlist') }}' method='POST'>
                                    @method('POST')
                                    @csrf
                                    <input name='course_id' type='hidden' value='{{ $course->id }}'>
                                    <input name='student_id' type='hidden' value='{{ Auth::user()->id }}'>
                                    @if (empty($wRecord))
                                        <button class='btn btn-primary' type='submit' style="background-color:#009DA6; border-color:#009DA6; border-radius:50%">
                                            <i class="bi bi-bookmark-check"></i>      
                                        </button>
                                    @else
                                        <button class="btn btn-primary" type='submit' style="background-color:#F95700FF; border-color:#F95700FF; border-radius:50%">
                                            <i class="bi bi-bookmark-check"></i>
                                        </button>
                                    @endif
                                </form>    

                                <!-- Add Rating Modal -->
                                <button type="button" class="btn btn-primary ms-3 rounded-circle" data-bs-toggle="modal" data-bs-target="#rate" style="background-color:#FF9529; border-color:#FF9529;">
                                    <i class="bi bi-star"></i>                                
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="rate" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="rateModalLabel"><b>Write a Review</b></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('users.add.rating') }}" method="POST" class="form-vertical">
                                                @method('POST')
                                                @csrf
                                                <div class="modal-body">
                                                    <input name="course_id" value="{{ $course->id }}" hidden class="form-control @error('course_id') is-invalid @enderror">
                                                    @error('course_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="rate col-md-5" style="margin-right: 50%; margin-left: 30%">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>   
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12" style="margin-left:-3%">Your Review *</label>
                                                        <textarea class="col-md-12" name="review" rows="3"></textarea>
                                                        @error('review')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" style="background-color:#009DA6; border-color:#009DA6;">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        @endif
                    @endguest
                </div>
            </div>    
        </div>

        <div class="container mt-5">
            @if ($message = session('message'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif
            <div class="mb-5">
                <h3><b>Course Overview</b></h3>
                <p class="col-md-11 mt-4">{{ $course->course_overview }}</p>
            </div>
            <div class="mb-5">
                <h3 class="mb-4"><b>Instructor Detail</b></h3>
                <div class="d-flex mb-4">
                    @if (empty($course->instructor->profile_picture))
                        <img src="{{ url('images/defaultProfile.png') }}" class="rounded-circle" width="150" style="background-color:white">
                    @else 
                        <img src="{{ asset('storage/profile_pictures/'.$course->instructor->profile_picture) }}" class="rounded-circle" alt="Upload poster image" style="width: 150px; height:150px; border: 3px solid black;">
                    @endif
                    <div class="ms-4 mt-4">
                        <h5><b>{{ $course->instructor->name }}</b></h5>
                        <ul>
                            @foreach ($job_titles as $job_title)
                                <li>{{ $job_title->job_title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <p class="col-md-11">{{ $course->instructor->description }}</p>
            </div>
            <div class="row mb-5">
                <h4 class="mb-4"><b>Ratings & Reviews of {{ $course->title }}</b></h4>
                
                <div>
                    <h1><b class="fs-1">{{ $avgRating }}</b><span class="fs-3" style="color:grey;">/5 </span><span class="mb-3 mt-3 fs-6" style="font-size: 90%"> {{ $ratingCount }} Ratings</span></h1>
                    
                    <?php
                        $star = 1;
                        while($star <= $avgStarRating){ ?>
                            <span class="fs-2">&#11088;</span>
                    <?php $star++; } ?>
                    
                </div>
                <p class="py-2 border-dark border-top border-bottom mt-3">Product Reviews</p>
                @if (count($ratings) > 0)
                    @foreach ($ratings as $rating)
                        <div>
                            <p></p>
                            <?php
                                $count = 1;
                                while($count <= $rating->rating){ ?>
                                    <span>&#11088;</span>
                            <?php $count++; } ?>
                            <p></p>
                            <p>By: {{ $rating->user->name }}</p>
                            <p>{{ $rating->review }}</p>
                            <p>{{ date('d-m-Y H:i:s', strtotime($rating->created_at)) }}</p>
                            <hr style="border-top: 2px solid black;">
                        </div>
                    @endforeach
                @else
                    <p><b>Ratings not available for this course.</b></p>
                @endif
            </div>
            <div class="mb-5">
                <h3 class="mb-4"><b>Curriculums</b></h3>
                @guest
                    @foreach ($chapters as $chapter)
                        <div class="d-flex ms-4">
                            <div class="col-md-2" style="color: #808080;">
                                <h4 class="col-md-3 d-flex justify-content-center mb-4">Chapter</h4>
                                <h4 class="col-md-3 d-flex justify-content-center">{{ $chapter->chapter_no }}</h4>
                            </div>
                            <div class="col-md-9" style="color: black;">
                                <h4 class="mb-4"><b>{{ $chapter->title }}</b></h4>
                                <p class="mb-5">{{ $chapter->overview }}</p>
                                <hr style="border-top: 2px solid black;">
                            </div>
                        </div>
                    @endforeach
                @else
                    @if (auth()->user()->type == 'student')
                        @if (empty($eRecord))
                            @foreach ($chapters as $chapter)
                                <div class="d-flex ms-4">
                                    <div class="col-md-2" style="color: #808080;">
                                        <h4 class="col-md-3 d-flex justify-content-center mb-4">Chapter</h4>
                                        <h4 class="col-md-3 d-flex justify-content-center">{{ $chapter->chapter_no }}</h4>
                                    </div>
                                    <div class="col-md-9" style="color: black;">
                                        <h4 class="mb-4"><b>{{ $chapter->title }}</b></h4>
                                        <p class="mb-5">{{ $chapter->overview }}</p>
                                        <hr style="border-top: 2px solid black;">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($chapters as $chapter)
                                <a href="{{ route('users.chapter', $chapter->id) }}" style="text-decoration: none;">
                                    <div class="d-flex ms-4">
                                        <div class="col-md-2" style="color: #808080;">
                                            <h4 class="col-md-3 d-flex justify-content-center mb-4">Chapter</h4>
                                            <h4 class="col-md-3 d-flex justify-content-center">{{ $chapter->chapter_no }}</h4>
                                        </div>
                                        <div class="col-md-9" style="color: black;">
                                            <h4 class="mb-4"><b>{{ $chapter->title }}</b></h4>
                                            <p class="mb-5">{{ $chapter->overview }}</p>
                                            <hr style="border-top: 2px solid black;">
                                        </div>
                                    </div>
                                </a>
                            @endforeach   
                        @endif
                    @else
                        @foreach ($chapters as $chapter)
                            <div class="d-flex ms-4">
                                <div class="col-md-2" style="color: #808080;">
                                    <h4 class="col-md-3 d-flex justify-content-center mb-4">Chapter</h4>
                                    <h4 class="col-md-3 d-flex justify-content-center">{{ $chapter->chapter_no }}</h4>
                                </div>
                                <div class="col-md-9" style="color: black;">
                                    <h4 class="mb-4"><b>{{ $chapter->title }}</b></h4>
                                    <p class="mb-5">{{ $chapter->overview }}</p>
                                    <hr style="border-top: 2px solid black;">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endguest
                <div class="d-flex justify-content-center mt-3">
                    {{ $chapters->links() }}
                </div>
            </div>
        </div>
    </main>

    <div class="container-fluid justify-content-center d-flex" style="background-color: #464849; margin-bottom: ">
        <footer class="container row row-cols-1 row-cols-sm-2 row-cols-md-5 py-4 my-4 border-top d-flex justify-content-center">
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
        </footer>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>
