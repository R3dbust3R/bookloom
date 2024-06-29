<header class="main-header bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="sub-containwer mt-5">
                    @guest
                        <h2 class="header-title text-capitalize">Welcome back to <span class="text-warning fw-bold">BookLoom</span>. The best eBooks platform for reviews</h2>
                        <p class="lead my-4">Discover reviews, eBooks from different readers from all over the world!</p>
                    @endguest

                    @auth
                        <h2 class="header-title text-capitalize">Hello <span>{{ Auth::user()->name }}</span>, Welcome back to <span class="text-warning fw-bold">BookLoom</span>. The best eBooks platform for reviews</h2>
                    @endauth

                    <a href="{{ route('review.index') }}" class="btn btn-outline-dark px-5 py-3 rounded-pill"><i class="fa-solid fa-magnifying-glass"></i> Explore Latest Books & Reviews</a>

                    @guest
                        <a href="{{ route('auth.signup-form') }}" class="btn btn-warning px-5 py-3 rounded-pill mt-2"><i class="fa-solid fa-plus"></i> Create Account</a>
                    @endguest
                </div>
            </div>
            <div class="col-md-6">
                <div class="img">
                    <img 
                        src="https://cdni.iconscout.com/illustration/premium/thumb/open-book-5514317-4603564.png" 
                        alt="header image" 
                        class="w-100 img-fuild">
                </div>
            </div>
        </div>
    </div>
</header>