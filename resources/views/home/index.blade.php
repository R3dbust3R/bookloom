<x-layout>

{{-- header --}}
<x-header></x-header>
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