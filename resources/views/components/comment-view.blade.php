@props(['comment', 'is_owner'])

<div class="comment-container border rounded-4 mb-4 p-4">

    <h6>
        <a href="{{ route('user.show', $comment->user) }}">
            <img 
                src="{{ asset('storage/' . ($comment->user->profile_image ? $comment->user->profile_image : 'users/default.png')) }}" 
                alt="{{ $comment->user->name }}'s profile image"
                class="rounded-circle img-thumbnail"
                style="width: 32px;">
            {{ $comment->user->name }}
        </a>
    </h6>
    <div class="meta text-muted fs-6">
        Published: {{ $comment->created_at->DiffForHumans() }}
    </div>
    <p class="lead m-0">
        {{ $comment->comment }}
    </p>

    {{-- owner controls --}}
    @auth
        @if ($is_owner)
            <div class="owner-controls mt-4">
                <a href="{{ route('comment.edit', $comment) }}" class="btn btn-primary btn-sm px-3 rounded-pill">Edit</a>
                <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm px-3 rounded-pill">
                </form>
            </div>
        @endif
    @endauth
    {{-- owner controls --}}

</div>