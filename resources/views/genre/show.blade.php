<x-layout>

{{-- header --}}
<header class="text-center bg-warning py-5 mb-2">
    <div class="container">
        <h2 class="section-title text-capitalize"> 
            {{ $genre->name }} 
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
                    <x-book-view :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>
    </div>
</section>
{{-- books --}}



</x-layout>