<x-layout>

{{-- header --}}
<header class="language-header text-center py-5 mb-2">
    <div class="container">
        <h2 class="section-title title-center text-capitalize text-light py-4"> 
            {{ $language->name }}
        </h2>
    </div>
</header>
{{-- header --}}

{{-- books --}}
<section class="latest-books py-5">
    <div class="container">
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :is_owner="Auth::id() == $book->user_id" :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>

        {{-- pagination --}}
        <div class="pagination">
            {{ $books->links() }}
        </div>
        {{-- pagination --}}
    </div>
</section>
{{-- books --}}



</x-layout>