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
                <li class="nav-item"><span class="btn bg-white rounded-circle"><i class="fa-solid fa-magnifying-glass"></i></span></li>
                <li class="nav-item"><a href="#" class="nav-link mx-2">Reviews</a></li>
                <li class="nav-item"><a href="{{ route('home.about') }}" class="nav-link mx-2">About us</a></li>
                <li class="nav-item"><a href="#" class="btn btn-warning px-4 rounded-pill mx-2"><i class="fa-regular fa-pen-to-square"></i> Write a review</a></li>
                <li class="nav-item"><a href="#" class="nav-link bg-white rounded-circle px-3 mx-2"><i class="fa-regular fa-user"></i></a></li>
            </div>

          </div>
        </div>
    </nav>
    {{-- navbar --}}
    
    {{ $slot }}

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
                        <li><a href="#" class="text-light">Books</a></li>
                        <li><a href="#" class="text-light">Reviews</a></li>
                        <li><a href="#" class="text-light">Profile</a></li>
                        <li><a href="#" class="text-light">Settings</a></li>
                    </ul>
                </div>

                <div class="col-sm-6 col-md-3">
                    <h4>Useful Links</h4>
                    <ul class="list-unstyled fw-light">
                        <li><a href="#" class="text-light">Terms and conditions</a></li>
                        <li><a href="#" class="text-light">Privacy policy</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/33189c9c9d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>