<x-layout>

{{-- header --}}
<header class="header bg-light text-center py-5">
    <h2>Reviews</h2>
</header>
{{-- header --}}

{{-- reviews --}}
<div class="reviews mt-4">
    <div class="container">
        
        <div class="row">
            @foreach ($reviews as $review)
                <div class="col-md-6 d-flex">
                    <div class="review rounded-4 border bg-light p-3 mb-3">

                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{ route('book.show', $review->book) }}">
                                    <img 
                                    src="{{ asset($review->book->cover ? 'storage/' . $review->book->cover : 'storage/books/default.png') }}"
                                    alt="{{ $review->book->title }} Cover"
                                    class="d-block rounded-3 border w-100">
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <h4 class=""> <a href="{{ route('book.show', $review->book) }}">{{ $review->book->title }}</a> </h4>
                                <hr>
                                <span class="rating">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor

                                    @for ($i = 0; $i < 5 - $review->rating; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </span>

                                <h5 class="user">
                                    Review by: 
                                    <a href="{{ route('user.show', $review->user) }}"> 
                                        <img 
                                            src="{{ asset($review->user->profile_image ? 'storage/' . $review->user->profile_image : 'storage/users/default.png') }}" 
                                            alt="{{ $review->user->name }}'s profile image"
                                            class="rounded-circle img-thumbnail" style="width: 32px;"> 
                                        {{ $review->user->name }}
                                    </a>
                                    <span class="date text-muted fs-6">
                                        <i class="fa-solid fa-clock"></i> {{ $review->created_at->DiffForHumans() }}
                                    </span>
                                </h5>

                                <p class="lead">
                                    {{ $review->review }}
                                </p>

                                {{-- owner controls --}}
                                @if ($review->user_id == Auth::id())
                                    <div class="owner-controls btn-group w-100">
                                        <a href="{{ route('book.show', $review->book_id) }}#review-form" class="btn btn-primary rounded-start-3 w-50"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <form action="{{ route('review.destroy', $review) }}" method="POST" class="d-inline-block w-50">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-start-0 rounded-end-3 w-100"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                        </form>
                                    </div>
                                @endif
                                {{-- owner controls --}}

                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- pagination --}}
        <div class="pagination py-5">
            {{ $reviews->links() }}
        </div>
        {{-- pagination --}}

    </div>
</div>
{{-- reviews --}}

</x-layout>