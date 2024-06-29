<x-layout>


{{-- header --}}
<header class="profile-header bg-light">
    <div class="container">

        <div 
            class="profile-banner text-center rounded-4" 
            style="background-image: url({{ asset('storage/' . (Auth::user()->profile_banner ? Auth::user()->profile_banner : 'users/bananers/default.png')) }})">
        </div>

        <div class="profile-img-container text-center position-relative">
            <img 
            src="{{ asset('storage/' . (Auth::user()->profile_image ? Auth::user()->profile_image : 'users/default.png')) }}" 
            alt="profile image"
            class="profile-img rounded-circle border img-thumbnail d-block m-auto">
            
            <h4 class="my-2">
                {{ Auth::user()->name }}
            </h4>
            <span class="text-muted"> <i class="fa-regular fa-calendar-days"></i> Member: {{ Auth::user()->created_at->DiffForHumans() }} </span>
        </div>

    </div>
</header>
{{-- header --}}


{{-- about --}}
<section class="about py-5">
    <div class="container">
        <h4 class="text-capitalize my-2">About {{ Auth::user()->name }}</h4>
        <p class="lead">
            {{ Auth::user()->bio }}
        </p>
    </div>
</section>
{{-- about --}}


{{-- books --}}
<section class="books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ Auth::user()->name }}'s books</h2>

        <div class="row">

            @foreach (Auth::user()->books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view is_owner :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>

    </div>
</section>
{{-- books --}}

</x-layout>