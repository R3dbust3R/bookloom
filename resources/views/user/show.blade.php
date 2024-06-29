<x-layout>


{{-- header --}}
<header class="profile-header bg-light py-5">
    <div class="container">

        <div class="profile_banner text-center">
            <img 
            src="{{ asset($user->profile_image ? 'storage/' . $user->profile_image : 'storage/users/default.png') }}" 
            alt="{{ $user->name }}'s profile image"
            class="profile-img d-block m-auto rounded-circle border"
            style="width: 140px">
            <h4 class="my-2"> {{ $user->name }} </h4>
            <span class="text-muted"> <i class="fa-regular fa-calendar-days"></i> Member: {{ $user->created_at->DiffForHumans() }} </span>
        </div>

    </div>
</header>
{{-- header --}}


{{-- about --}}
<section class="about py-5">
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

            @foreach ($user->books as $book)
                <div class="col-md-4 col-lg-3">
                    <x-book-view :book="$book"></x-book-view>
                </div>
            @endforeach

        </div>
    </div>
</section>
{{-- books --}}

</x-layout>