<x-layout>


{{-- about us --}}
<section class="latest-books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ $book->title }} </h2>

        <div class="row">

            <div class="col-md-6">
                <book class="cover">
                    <img 
                        src="{{ asset($book->cover ? 'storage/' . $book->cover : 'storage/books/default.png') }}" 
                        alt="{{ $book->title }}"
                        class="d-block w-100">
                </book>
            </div>

            <div class="col-md-6">
                <div class="meta bg-light p-5">
                    <div class="lead text-capitalize"><i class="fa-solid fa-user-tie"></i> <span class="fw-bold">Author:</span> {{ $book->author }} </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-user"></i> <span class="fw-bold">Published by:</span> <a href="{{ route('user.show', $book->user) }}">{{ $book->user->name }}</a> </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-clock"></i> <span class="fw-bold">Published:</span> {{ $book->created_at->DiffForHumans() }} </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-earth-asia"></i> <span class="fw-bold">Language:</span> <a href="{{ route('language.show', $book->language) }}">{{ $book->language->name }}</a> </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-layer-group"></i> <span class="fw-bold">Genre</span> <a href="{{ route('genre.show', $book->genre) }}">{{ $book->genre->name }}</a> </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-file"></i> <span class="fw-bold">Pages:</span> {{ $book->page_count }} pages</div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-eye"></i> <span class="fw-bold">Views:</span> {{ $book->views }} times </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-cloud-arrow-down"></i> <span class="fw-bold">Downloaded:</span> {{ $book->downloaded_times }} times </div> 
                </div>
                <hr>
                <div class="btns bg-light px-5 py-3">
                    <a href="{{ route('book.read', $book) }}" class="btn btn-primary px-4 rounded-pill"><i class="fa-brands fa-readme"></i> Read book</a>
                    <a href="{{ asset('storage/books/books/' . $book->book_url) }}" target="_blank" class="btn btn-primary px-4 rounded-pill"><i class="fa-solid fa-cloud-arrow-down"></i> Download book</a>
                </div>
                
                @auth 
                    @if (Auth::user()->id == $book->user_id)
                        <div class="btns bg-light mb-4 px-5 pb-3">
                            <a href="#" class="btn btn-success px-4 rounded-pill"><i class="fa-solid fa-edit"></i> Edit book</a>
                            <a href="#" class="btn btn-danger  px-4 rounded-pill"><i class="fa-solid fa-trash"></i> Delete book</a>
                        </div>
                    @endif
                @endauth
            </div>

        </div>
        
        {{-- desc --}}
        <div class="description bg-light p-5 mt-4">
            <h3 class="sub-title mb-4">Description</h3>
            <p class="lead">{{ $book->description }}</p>
        </div>
        {{-- desc --}}

        {{-- comments --}}
        <div class="comments bg-light p-5 mt-4">
            <h3 class="sub-title mb-4">Comments</h3>
            @if ($book->comments->count() > 0)
                @foreach ($book->comments as $comment)
                    <x-comment-view :comment="$comment"></x-comment-view>
                @endforeach
            @else
                <p class="lead">No comments for this book</p>
            @endif
        </div>
        {{-- comments --}}

    </div>
</section>
{{-- about us --}}



</x-layout>