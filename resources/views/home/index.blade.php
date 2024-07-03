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
                    <x-book-view :is_owner="Auth::id() == $book->user_id" :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('book.index') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fa-solid fa-book"></i> All Books
            </a>
        </div>

    </div>
</section>
{{-- latest books --}}

{{-- latest reviews --}}
<section class="latest-reviews bg-light py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Latest Reviews</h2>
        <div class="reviews">

            @foreach ($reviews as $review)
                <div class="single-review bg-white border rounded-4 p-3 mb-4">
                    <div class="row">
                        <div class="col-2">
                            <img 
                                src="{{ asset('storage/' . ($review->book->cover ? $review->book->cover : 'books/default.png')) }}" 
                                alt="Review thumbnail: {{ $review->book->title }}"
                                class="d-block w-100 rounded-3 img-thumbnail">
                        </div>
                        <div class="col-10">
                            <div class="py-4">
                                <h5> Review by: <a href="{{ route('user.show', $review->user) }}"> {{ $review->user->name }} </a> </h5>
                                <p class="text-muted">
                                    <span class="d-block">Review on: <a href="{{ route('book.show', $review->book) }}"> {{ $review->book->title }} </a></span>
                                    <span class="d-block"><i class="fa-solid fa-clock"></i> {{ $review->created_at->DiffForHumans() }}</span>
                                </p>
                                <blockquote class="text-muted fs-5">
                                    {{ $review->review }}
                                </blockquote>
                                <span class="d-block rating fs-4 mb-2">
                                    @for ($i = 0; $i < $review->rating; $i++) <i class="fa-solid fa-star"></i> @endfor
                                    @for ($i = 0; $i < 5 - $review->rating; $i++) <i class="fa-regular fa-star"></i> @endfor
                                </span>
                                {{-- owner controls --}}
                                <div class="owner-controlers">
                                    @if (Auth::id() == $review->user->id)
                                        <div class="btn-group">
                                            <a href="{{ route('book.show', $review->book) }}#review-form" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                            <form action="{{ route('review.destroy', $review) }}" method="POST" class="d-inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn rounded-start-0 btn-danger"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                {{-- owner controls --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('review.index') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fa-solid fa-star"></i> All Reviews
            </a>
        </div>

    </div>
</section>
{{-- latest reviews --}}


{{-- genres --}}
<section class="latest-books bg-white py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Book<span class="text-warning">Loom</span> categories</h2>
        <div class="row">

            @foreach ($genres as $genre)

                @if ($genre->books->count())
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="genre bg-light border rounded-3 position-relative mb-4">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-primary">{{ $genre->books->count() }}</span>
                            <h4 class="text-capitalize genre m-0">
                                <a href="{{ route('genre.show', $genre) }}" class="d-block w-100 p-4">
                                    {{ $genre->name }}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endif
                
            @endforeach

        </div>
    </div>
</section>
{{-- genres --}}

{{-- random quote --}}
<section class="latest-books bg-light py-5">
    <div class="container">
        <div class="random-quote bg-dark text-warning rounded-4 p-5">
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