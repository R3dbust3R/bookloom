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
                href="{{ asset('storage/' . $book->book_url ) }}" 
                download="{{ $book->title }}.pdf">Download This Book</a>
        </div>
    </div>
</header>
{{-- header --}}


{{-- book view --}}
<section class="book text-center">
    <iframe src="{{ asset('storage/' . $book->book_url ) }}" width="96%" height="1200px"></iframe>
</section>
{{-- book view --}}



</x-layout>