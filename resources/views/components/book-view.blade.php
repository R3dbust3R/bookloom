@props(['book', 'is_owner' => false])

<div class="single-book-container bg-light border rounded-4 overflow-hidden mb-4">
    <a href="{{ route('book.show', $book) }}">
        <img 
        src="{{ asset($book->cover ? 'storage/' . $book->cover : 'storage/books/default.png') }}" 
        alt="{{ $book->title }}"
        class="w-100">
    </a>

    <div class="footer p-3">
        <h5 class="text-capitalize">
            <a href="{{ route('book.show', $book) }}">
                {{ $book->title }}
            </a>
        </h5>
        <div class="meta my-2">
            <span class="rating">
                @for ($i = 0; $i < ceil($book->reviews->avg('rating')); $i++)
                    <i class="fa-solid fa-star"></i>
                @endfor
                @for ($i = 0; $i < 5 - ceil($book->reviews->avg('rating')); $i++)
                    <i class="fa-regular fa-star"></i>
                @endfor
            </span>
            {{-- <span class="d-block text-muted">Written by: <a href="#">{{ $book->author }}</a></span> --}}
            <span class="d-block text-muted">Published by: <a href="{{ route('user.show', $book->user) }}">{{ $book->user->name }}</a></span>
            {{-- <span class="d-block text-muted">Published: {{ $book->created_at->DiffForHumans() }}</span> --}}
            {{-- <span class="d-block text-muted">Pages: {{ $book->page_count }}</span> --}}
            {{-- <span class="d-block text-muted">Viewed: {{ $book->views }}</span> --}}
            <span class="d-block text-muted">Downloaded: {{ $book->downloaded_times }} times</span>
        </div>
        <a href="{{ route('book.read', $book) }}" class="btn btn-warning btn-sm rounded-pill px-4 mb-1">Read</a>
        <a href="{{ asset('storage/books/books/' . $book->book_url ) }}" download="{{ asset('storage/books/books/' . $book->book_url ) }}" class="btn btn-dark btn-sm rounded-pill px-4 mb-1">Download</a>

        @if ($is_owner)
            <a href="{{ route('book.edit', $book) }}" class="btn btn-success btn-sm rounded-pill px-4 mb-1">Edit</a>
            <form action="{{ route('book.destroy', $book) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger btn-sm rounded-pill px-4 mb-1">
            </form>
        @endif

    </div>
</div>