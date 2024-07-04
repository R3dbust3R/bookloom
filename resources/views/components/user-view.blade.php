@props(['user', 'books', 'sharedBooks'])

{{-- header --}}
<header class="profile-header bg-light">
    <div class="container">

        {{-- alert messages --}}
        @session('success')
            <div class="alert alert-success">
                <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
            </div>
        @endsession

        @session('error')
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endsession
        {{-- alert messages --}}

        <div 
            class="profile-banner text-center rounded-4" 
            style="background-image: url({{ asset('storage/' . ($user->profile_banner ? $user->profile_banner : 'users/banners/default.png')) }})">
        </div>

        <div class="profile-img-container text-center position-relative">
            <img 
            src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'users/default.png')) }}" 
            alt="profile image"
            class="profile-img rounded-circle border img-thumbnail d-block m-auto">
            
            <h4 class="text-capitalize my-2">
                @if ($user->id == Auth::id())
                    <a href="{{ route('user.settings') }}#profile-image-form" class="btn btn-warning rounded-circle border edit-icon position-absolute"><i class="fa-solid fa-pen"></i></a>
                @endif
                {{ $user->name }}
            </h4>
            <span class="text-muted"> <i class="fa-regular fa-calendar-days"></i> Member: {{ $user->created_at->DiffForHumans() }} </span>

        </div>

    </div>
</header>
{{-- header --}}


{{-- about --}}
<hr>
<section class="about bg-light py-5">
    <div class="container">
        <h4 class="text-capitalize my-2">
            <span class="text-muted">About</span> {{ $user->name }}
            <span class="badge text-bg-warning fw-light">&commat;{{ $user->username }}</span>
        </h4>
        <p class="lead">
            {{ $user->bio }}
        </p>
    </div>
</section>
{{-- about --}}



{{-- shared books --}}
<section class="shared-books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ $user->name }}'s Shares</h2>
        <div class="row">

            @foreach ($sharedBooks as $sharedBook)
                <div class="col-md-6 mb-3">
                    <div class="shared-book p-3 rounded-4 bg-light border">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('book.show', $sharedBook) }}">
                                    <img class="img-thumbnail w-100 d-block rounded-3" src="{{ asset('storage/' . ($sharedBook->cover ? $sharedBook->cover : 'books/default.png')) }}" alt="{{ $sharedBook->title }}'s cover">
                                </a>
                            </div>
                            <div class="col-8">
                                <h5> <a href="{{ route('book.show', $sharedBook) }}"> {{ $sharedBook->title }} </a> </h5>
                                <div class="met">
                                    <p class="text-muted">
                                        Published by: <a href="{{ route('user.show', $sharedBook->user) }}"> {{ $sharedBook->user->name }} </a> <br>
                                        <i class="fa-solid fa-clock"></i> {{ $sharedBook->created_at->DiffForHumans() }}
                                    </p>
                                    <p class="text-muted m-0"> {{ Str::words($sharedBook->description, 16) }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>
{{-- shared books --}}



{{-- books --}}
<section class="books py-5">
    <div class="container">
        <h2 class="section-title text-capitalize mb-4"> {{ $user->name }}'s books</h2>
        <div class="row">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :is_owner="$user->id == Auth::id()" :book="$book"></x-book-view>
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