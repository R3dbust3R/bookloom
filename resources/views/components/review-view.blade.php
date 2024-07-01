@props(['review', 'is_owner'])

<div class="review-container border rounded-4 mb-4 p-4">

    <h6>
        <a href="{{ route('user.show', $review->user) }}">
            <img 
                src="{{ asset('storage/' . ($review->user->profile_image ? $review->user->profile_image : 'users/default.png')) }}" 
                alt="{{ $review->user->name }}'s profile image"
                class="rounded-circle img-thumbnail"
                style="width: 32px;">
            {{ $review->user->name }}
        </a>
    </h6>
    <div class="meta text-muted fs-6">
        Published: {{ $review->created_at->DiffForHumans() }}
    </div>
    <span class="rating">
        @for ($i = 0; $i < $review->rating; $i++)
            <i class="fa-solid fa-star"></i>
        @endfor
        @for ($i = 0; $i < 5 - $review->rating; $i++)
            <i class="fa-regular fa-star"></i>
        @endfor
    </span>
    <p class="text-muted m-0">
        {{ $review->review }}
    </p>

    {{-- owner controls --}}
    @auth
        @if ($is_owner)
            <div class="owner-controls mt-4">
                <a href="#review-form" class="btn btn-primary btn-sm px-3 rounded-pill">Edit</a>
                <form action="{{ route('review.destroy', $review) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm px-3 rounded-pill">
                </form>
            </div>
        @endif
    @endauth
    {{-- owner controls --}}

</div>