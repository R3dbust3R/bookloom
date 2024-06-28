<x-layout>

{{-- header --}}
<header class="main-header bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="sub-containwer mt-5">
                    <h1 class="header-title"><span class="text-warning fw-bold">BookLoom</span> Reviews and tips for books</h1>
                    <p class="lead">Discover reviews of books from different readers from all over the world</p>
                    <a href="#" class="btn btn-warning px-4 py-2 rounded-pill">Explore reviews and tips</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img">
                    <img 
                        src="https://cdni.iconscout.com/illustration/premium/thumb/open-book-5514317-4603564.png" 
                        alt="header image" 
                        class="w-100 img-fuild">
                </div>
            </div>
        </div>
    </div>
</header>
{{-- header --}}

{{-- latest books --}}
<section class="latest-books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Latest books</h2>
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>
    </div>
</section>
{{-- latest books --}}


{{-- books genres --}}
<section class="latest-books bg-light py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4">Discover popular genres</h2>
        <div class="row">
            @for ($i = 0; $i < 4; $i++)

                <div class="col-md-6">
                    <div class="genre bg-white p-5 mb-4">
                        <h4 class="text-capitalize genre m-01">genre</h4>
                    </div>
                </div>

            @endfor
        </div>
    </div>
</section>
{{-- books genres --}}

{{-- random quote --}}
<section class="latest-books py-5">
    <div class="container">
        <div class="random-quote bg-warning rounded-4 p-5">
            <div class="icon mb-4">
                <i class="fa-solid fa-quote-left fs-1"></i>
            </div>
            <p class="lead fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis quisquam autem iusto consequuntur modi, saepe facilis impedit explicabo rem itaque minus corrupti dolorem tempora deserunt possimus earum placeat, reiciendis adipisci? Sit qui quas sapiente inventore!</p>
            <div class="owner fs-4"><i class="fa-solid fa-minus"></i> Jack Watson</div>
        </div>
    </div>
</section>
{{-- random quote --}}

</x-layout>