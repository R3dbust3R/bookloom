<x-layout>


{{-- header --}}
<header class="profile-header bg-light py-5">
    <div class="container">

        <div class="profile_banner text-center">
            <img 
            src="{{ asset('storage/users/default.png') }}" 
            alt="profile image"
            class="profile-img d-block m-auto rounded-circle border">
            <h4 class="my-2">
                User Name
            </h4>
            <span class="text-muted"> <i class="fa-regular fa-calendar-days"></i> Member: Date </span>
        </div>

    </div>
</header>
{{-- header --}}


{{-- about --}}
<section class="about py-5">
    <div class="container">
        <h4 class="my-2">About User</h4>
        <p class="lead">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum eum inventore accusamus magnam amet magni voluptate veniam distinctio, dolor numquam dolorem dignissimos voluptas, officia corporis pariatur nulla aliquid fuga aperiam voluptatem exercitationem!
        </p>
    </div>
</section>
{{-- about --}}


{{-- books --}}
<section class="books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> User's books</h2>
        <div class="row">

            @for ($i = 0; $i < 8; $i++)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="book-holder p-4 bg-light">
                        <h4>Book title</h4>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, natus dolorum? Fuga.</p>
                        <div class="actions">
                            <a class="btn btn-danger" href="">Button 1</a>
                            <a class="btn btn-danger" href="">Button 2</a>
                        </div>
                    </div>
                </div>
            @endfor

            {{-- @foreach ($user->books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :book="$book"></x-book-view>
                </div>
            @endforeach --}}

        </div>
    </div>
</section>
{{-- books --}}

</x-layout>