<x-layout>

{{-- books --}}
<section class="latest-books py-5">
    <div class="container">
        
        <h2 class="section-title text-capitalize mb-5">
            Results for: {{ $query }}
        </h2>

        <div class="row mb-5">
            <h3 class="border-bottom border-2 border-primary my-4 py-2">Users</h3>
            @if ($users->count() == 0)
                <p class="lead fs-4"><i class="fa-solid fa-hourglass"></i> No results</p>
            @endif
            @foreach ($users as $user)
                <div class="col-md-4 col-lg-3">
                    <a href="{{ route('user.show', $user) }}"
                       class="d-block w-100 p-2 bg-light rounded-2 mb-3 border border-dark-subtle">
                       <img 
                            src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'users/default.png')) }}" 
                            alt="{{ $user->name }} profile image"
                            class="rounded-circle img-thumbnail"
                            style="width: 36px;">
                        {{ $user->name }}
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row">
            <h3 class="border-bottom border-2 border-primary my-4 py-2">Books</h3>
            @if ($books->count() == 0)
                <p class="lead fs-4"><i class="fa-solid fa-hourglass"></i> No results</p>
            @endif
            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :is_owner="$book->user_id == Auth::id()" :book="$book"></x-book-view>
                </div>
            @endforeach
        </div>

        <div class="row">
            <h3 class="border-bottom border-2 border-primary my-4 py-2">Reviews</h3>
            @if ($reviews->count() == 0)
                <p class="lead fs-4"><i class="fa-solid fa-hourglass"></i> No results</p>
            @endif
            @foreach ($reviews as $review)
                <div class="col-md-4 col-lg-3">
                    <x-review-view :is_owner="$review->user_id == Auth::id()" :review="$review"></x-review-view>
                </div>
            @endforeach
        </div>
        
        {{-- pagination --}}
        {{-- <div class="pagination py-5">
            {{ $books->links() }}
        </div> --}}
        {{-- pagination --}}

    </div>
</section>
{{-- books --}}



</x-layout>