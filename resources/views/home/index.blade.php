<x-layout>

{{-- header --}}
<header class="main-header bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="sub-containwer mt-5">
                    <h1 class="header-title"><span class="text-warning fw-bold">BookLoom</span> Reviews and tips for books</h1>
                    <p class="lead my-4">Discover reviews of books from different readers from all over the world</p>
                    <a href="{{ route('review.index') }}" class="btn btn-outline-dark px-5 py-3 rounded-pill"><i class="fa-solid fa-magnifying-glass"></i> Explore Books Reviews</a>
                    <a href="#" class="btn btn-warning px-5 py-3 rounded-pill"><i class="fa-solid fa-plus"></i> Create Account</a>
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
{{-- header --}}

{{-- latest books --}}
<section class="latest-books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Latest books</h2>
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>
    </div>
</section>
{{-- latest books --}}


{{-- genres --}}
<section class="latest-books bg-light py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Discover popular categories</h2>
        <div class="row">

            @foreach ($genres as $genre)
            
                <div class="col-md-6">
                    <div class="genre bg-white mb-4">
                        <h4 class="text-capitalize genre m-0">
                            <a href="{{ route('genre.show', $genre) }}" class="d-block w-100 p-5">
                                {{ $genre->name }} {{ $genre->books->count() }}
                            </a>
                        </h4>
                    </div>
                </div>
                
            @endforeach

        </div>
    </div>
</section>
{{-- genres --}}

{{-- random quote --}}
<section class="latest-books py-5">
    <div class="container">
        <div class="random-quote bg-warning rounded-4 p-5">
            <div class="icon mb-4">
                <i class="fa-solid fa-quote-left fs-1"></i>
            </div>
            <p class="lead fs-4">
                Books are the perfect entertainment: no commercials, no batteries, hours of enjoyment for each dollar spent. What I wonder is why everybody doesn't carry a book around for those inevitable dead spots in life.
            </p>
            <div class="owner fs-4"><i class="fa-solid fa-minus"></i> Stephen King</div>
        </div>
    </div>
</section>
{{-- random quote --}}

</x-layout>