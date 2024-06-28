@props(['book'])

<div class="book-container bg-light mb-4">
    <a href="{{ route('book.show', $book) }}">
        <img 
        src="{{ asset($book->cover ? 'storage/' . $book->cover : 'storage/books/default.png') }}" 
        alt="{{ $book->title }}"
        class="w-100">
    </a>
    <hr>
    <div class="footer p-4">
        <h4 class="text-capitalize">
            <a href="{{ route('book.show', $book) }}">
                {{ $book->title }}
            </a>
        </h4>
        <div class="meta my-3">
            {{-- <span class="d-block text-muted">Written by: <a href="#">{{ $book->author }}</a></span> --}}
            <span class="d-block text-muted">Published by: <a href="{{ route('user.show', $book->user) }}">{{ $book->user->name }}</a></span>
            {{-- <span class="d-block text-muted">Published: {{ $book->created_at->DiffForHumans() }}</span> --}}
            {{-- <span class="d-block text-muted">Pages: {{ $book->page_count }}</span> --}}
            {{-- <span class="d-block text-muted">Viewed: {{ $book->views }}</span> --}}
            <span class="d-block text-muted">Downloaded: {{ $book->downloaded_times }} times</span>
        </div>
        <a href="{{ route('book.read', $book) }}" class="btn btn-primary btn-sm rounded-pill px-3"><i class="fa-solid fa-book-open-reader"></i> Read</a>
        <a href="{{ route('book.download', $book) }}" class="btn btn-primary btn-sm rounded-pill px-3"><i class="fa-solid fa-download"></i> Download</a>
    </div>
</div>