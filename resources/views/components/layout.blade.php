<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bookloom-styles.css">
    <title>BookLoom</title>
</head>
<body>

    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-light py-4">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">Book<span class="text-warning">Loom</span></a>
            </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

            <div class="navbar-nav">

                @auth
                    <li class="nav-item"><button id="search-btn" class="btn bg-white rounded-circle"><i class="fa-solid fa-magnifying-glass"></i></button></li>
                    <li class="nav-item"><a href="{{ route('review.index') }}" class="btn btn-warning rounded-pill px-4 mx-2">Reviews</a></li>
                    <li class="nav-item"><a href="{{ route('book.index') }}" class="nav-link mx-2">Books</a></li>
                @endauth

                
                @guest
                    <li class="nav-item"><a href="{{ route('home.about') }}" class="nav-link mx-2">About us</a></li>
                    <li class="nav-item"><a href="{{ route('login.form') }}" class="nav-link btn bg-white rounded-pill px-4 mx-2">Login</a></li>
                @endguest
                
                @auth
                    <li class="nav-item"><a href="{{ route('book.create') }}" class="nav-link bg-white rounded-circle px-3 mx-2"><i class="fa-regular fa-plus"></i></a></li>
                    <li class="nav-item"><a href="{{ route('user.profile') }}" class="nav-link bg-white rounded-circle px-3 mx-2"><i class="fa-regular fa-user"></i></a></li>
                    <li class="nav-item"><a href="{{ route('auth.logout') }}" class="nav-link mx-2">Logout</a></li>
                @endauth
            </div>

          </div>
        </div>
    </nav>
    {{-- navbar --}}

    {{-- search form --}}
    <x-search-form></x-search-form>
    {{-- search form --}}

    {{-- page content --}}
    {{ $slot }}
    {{-- page content --}}

    {{-- footer --}}
    <footer class="footer bg-dark text-light py-5">
        <div class="container pt-4">
            <div class="row">

                <div class="col-sm-12 col-md-6">
                    <h3><a href="{{ route('home.index') }}" class="text-light">Book<span class="text-warning">Loom</span></a></h3>
                    <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum ipsa aliquam nam?</p>
                    <p class="copyright fw-light">
                        Designed & Developed with <i class="fa-solid fa-heart"></i> by OTMANE TALHAOUI <br>
                        &copy; BookLoom {{ date('Y') }}
                    </p>
                </div>

                <div class="col-sm-6 col-md-3">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled fw-light">
                        <li><a href="{{ route('home.about') }}" class="text-light">About us</a></li>
                        
                        @auth
                            <li><a href="{{ route('book.index') }}" class="text-light">Books</a></li>
                            <li><a href="{{ route('review.index') }}" class="text-light">Reviews</a></li>
                            <li><a href="{{ route('user.profile') }}" class="text-light">Profile</a></li>
                            <li><a href="#" class="text-light">Settings</a></li>
                        @endauth
                    </ul>
                </div>

                <div class="col-sm-6 col-md-3">
                    <h4>Useful Links</h4>
                    <ul class="list-unstyled fw-light">
                        <li><a href="{{ route('home.terms-and-conditions') }}" class="text-light">Terms and conditions</a></li>
                        <li><a href="{{ route('home.privacy-policy') }}" class="text-light">Privacy policy</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    {{-- footer --}}

    <script src="https://kit.fontawesome.com/33189c9c9d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="bookloom.js"></script>
</body>
</html>