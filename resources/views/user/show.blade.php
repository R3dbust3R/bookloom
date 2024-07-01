<x-layout>

{{-- header --}}
<header class="profile-header bg-light">
    <div class="container">

        <div 
            class="profile-banner text-center rounded-4" 
            style="background-image: url({{ asset('storage/' . ($user->profile_banner ? $user->profile_banner : 'users/bananers/default.png')) }})">
        </div>

        <div class="profile-img-container text-center position-relative">
            <img 
            src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'users/default.png')) }}" 
            alt="profile image"
            class="profile-img rounded-circle border img-thumbnail d-block m-auto">
            
            <h4 class="text-capitalize my-2">
                @auth
                    @if (Auth::user()->id == $user->id)
                        <a href="{{ route('user.edit') }}" class="btn btn-warning rounded-circle border edit-icon position-absolute"><i class="fa-solid fa-pen"></i></a>
                    @endif
                @endauth
                {{ $user->name }}
            </h4>
            <span class="text-muted"> <i class="fa-regular fa-calendar-days"></i> Member: {{ $user->created_at->DiffForHumans() }} </span>

        </div>

    </div>
</header>
{{-- header --}}

<hr>

{{-- about --}}
<section class="about bg-light py-5">
    <div class="container">
        <h4 class="my-2">About {{ $user->name }}</h4>
        <p class="lead"> {{ $user->bio }} </p>
    </div>
</section>
{{-- about --}}


{{-- books --}}
<section class="books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ $user->name }}'s books</h2>
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :is_owner="Auth::id() == $user->id" :book="$book"></x-book-view>
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