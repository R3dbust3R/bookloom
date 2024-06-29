<x-layout>


{{-- header --}}
<header class="header text-center bg-light py-5">
    <div class="container">
        <h2 class="section-title text-capitalize"> {{ $book->title }} </h2>
        <span class="text-muted">
            Written by: {{ $book->author }} <br>
            Published: {{ $book->created_at->DiffForHumans() }}
        </span>
        <div class="btns mt-4">
            <a 
                class="btn rounded-pill btn-warning px-4" 
                href="{{ asset('storage/books/books/' . $book->book_url ) }}" 
                download="{{ asset('storage/books/books/' . $book->book_url ) }}">Download This Book</a>
        </div>
    </div>
</header>
{{-- header --}}


{{-- book view --}}
<section class="book text-center">
    {{-- <embed src="{{ asset('storage/books/books/' . $book->book_url) }}" width="100%" height="1200" type="application/pdf"> --}}
    <iframe src="{{ asset('storage/books/books/' . $book->book_url ) }}" width="600" height="800"></iframe>
</section>
{{-- book view --}}



</x-layout>