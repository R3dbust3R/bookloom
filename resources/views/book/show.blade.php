<x-layout>


{{-- about us --}}
<section class="latest-books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ $book->title }} </h2>

        {{-- alert --}}
        @session('success')
            <div class="alert alert-success"> <i class="fa-solid fa-circle-check"></i> {{ session('success') }} </div>
        @endsession
        {{-- alert --}}

        <div class="row">

            <div class="col-md-6">
                <book class="cover">
                    <img 
                        src="{{ asset($book->cover ? 'storage/' . $book->cover : 'storage/books/default.png') }}" 
                        alt="{{ $book->title }}"
                        class="d-block img-thumbnail rounded-4 w-100">
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
                    <div class="lead text-capitalize"><i class="fa-solid fa-cloud-arrow-down"></i> <span class="fw-bold">Downloads:</span> {{ $book->downloaded_times }} times </div> 
                    <div class="lead text-capitalize"><i class="fa-solid fa-share"></i> <span class="fw-bold">Shares:</span> {{ $book->sharedBy->count() }} </div>
                    <div class="rating mt-3">
                        <span class="rating fs-4">
                            @for ($i = 0; $i < ceil($book->reviews->avg('rating')); $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - ceil($book->reviews->avg('rating')); $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </span>
                        <span class="text-muted fs-4"> ({{ $book->reviews->count() }}) </span>
                    </div>
                </div>
                <hr>
                <div class="btns bg-light px-5 py-3">
                    <a href="{{ route('book.read', $book) }}" class="btn btn-primary px-4 rounded-pill"><i class="fa-brands fa-readme"></i> Read</a>
                    <a href="{{ route('book.download', $book) }}" class="btn btn-primary px-4 rounded-pill"><i class="fa-solid fa-cloud-arrow-down"></i> Download</a>
                    {{-- share --}}
                    <a href="{{ route('book.share', $book) }}" class="btn btn-success px-4 rounded-pill">
                        <i class="fa-solid fa-share"></i> 
                        @if ($book->isShared())
                            Unshare
                        @else
                            Share
                        @endif
                    </a>
                    {{-- share --}}
                </div>

                
                @auth 
                    @if (Auth::user()->id == $book->user_id)
                        <div class="btns bg-light mb-4 px-5 pb-3">
                            <a href="{{ route('book.edit', $book) }}" class="btn btn-success px-4 rounded-pill"><i class="fa-solid fa-edit"></i> Edit</a>
                            <form 
                                action="{{ route('book.destroy', $book) }}"
                                method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                
                                <input type="submit" value="Delete" class="btn btn-danger px-4 rounded-pill">
                            </form>
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

            {{-- alerts --}}
            @session('comment_success')
                <div class="alert alert-success"> <i class="fa-solid fa-circle-check"></i> {{ session('comment_success') }} </div>
            @endsession

            @session('comment_error')
                <div class="alert alert-danger"> <i class="fa-solid fa-triangle-exclamation"></i> {{ session('comment_error') }} </div>
            @endsession
            {{-- alerts --}}

            @if ($comments->count() > 0)
                @foreach ($comments as $comment)
                    <x-comment-view :is_owner="Auth::id() == $comment->user_id" :comment="$comment"></x-comment-view>
                @endforeach
            @else
                <p class="lead">No comments for this book</p>
            @endif
            {{-- comment form --}}
            <form action="{{ route('comment.store') }}" method="POST" class="mt-4">
                @csrf
                <h4>Write a comment</h4>
                <input type="hidden" value="{{ $book->id }}" class="hidden" name="book_id">
                <textarea name="comment" rows="12" class="form-control rounded-4"></textarea>
                @error('comment')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror
                <input type="submit" value="Publish" class="btn btn-primary px-4 mt-3 rounded-pill">
            </form>
            {{-- comment form --}}
        </div>
        {{-- comments --}}

        {{-- reviews --}}
        <div class="reviews bg-light p-5 mt-4">
            <h3 class="sub-title mb-4">Reviews</h3>

            {{-- alerts --}}
            @session('review_success')
                <div class="alert alert-success"> {{ session('review_success') }} </div>
            @endsession

            @session('review_error')
                <div class="alert alert-danger"> {{ session('review_error') }} </div>
            @endsession
            {{-- alerts --}}

            @if ($reviews->count() > 0)
                @foreach ($reviews as $review)
                    <x-review-view :is_owner="Auth::id() == $review->user_id" :review="$review"></x-review-view>
                @endforeach
            @else
                <p class="lead">No reviews for this book</p>
            @endif
            {{-- review form --}}
            <form action="{{ route('review.update') }}" method="POST" class="mt-4" id="review-form">
                @csrf
                @method('PUT')

                <h4>Add a review</h4>
                
                <input type="hidden" value="{{ $book->id }}" class="hidden" name="book_id">
                <textarea name="review" rows="8" class="form-control rounded-4">{{ old('review') }}</textarea>
                @error('review')
                    <p class="text-danger"> {{ $message }} </p>
                @enderror

                <span id="review-rating" class="rating d-block fs-4 my-2">
                    <i data-value="1" class="rating-icon fa-regular fa-star c-pointer"></i>
                    <i data-value="2" class="rating-icon fa-regular fa-star c-pointer"></i>
                    <i data-value="3" class="rating-icon fa-regular fa-star c-pointer"></i>
                    <i data-value="4" class="rating-icon fa-regular fa-star c-pointer"></i>
                    <i data-value="5" class="rating-icon fa-regular fa-star c-pointer"></i>
                </span>
                <input id="rating-input" type="hidden" value="0" min="0" max="5" class="hidden" name="rating">
                @error('rating')
                <p class="text-danger"> {{ $message }} </p>
                @enderror

                <input type="hidden" value="{{ $book->id }}" class="hidden" name="book_id">

                <input type="submit" value="Publish" class="btn btn-primary px-4 mt-3 rounded-pill">
            </form>
            {{-- review form --}}
        </div>
        {{-- reviews --}}

    </div>
</section>
{{-- about us --}}



</x-layout>