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

    {{-- comment content --}}
    <p class="text-muted m-0">
        {{ $comment->comment }}
    </p>
    {{-- comment content --}}

    {{-- comment replies --}}
    @if ($comment->replies)
        <div class="replies">
            @foreach ($comment->replies as $reply)
                <div class="reply p-3 rounded-3 border mt-2">
                    <p class="text-muted m-0"> 
                        <a 
                            href="{{ route('user.show', $reply->user) }}"> 
                                <img 
                                    src="{{ asset('storage/' . ($reply->user->profile_image ? $reply->user->profile_image : 'users/default.png')) }}" 
                                    alt="{{ $reply->user->name }}'s profile image" 
                                    class="img-thumbnail rounded-circle"
                                    style="width: 32px;"> 
                            {{ $reply->user->name }}
                        </a> 
                    </p>
                    <p class="text-muted m-0">{{ $reply->comment }}</p>
                    @if ($reply->user->id == Auth::id())
                        <form action="{{ route('comment.destroy', $reply) }}" method="POST" class="d-inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-2 rounded-pill">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
    {{-- comment replies --}}

    {{-- likes / shares / replies --}}
    <div class="user-intractions text-muted fs-5">
        <span class="d-inline-block m-2">
            <a href="{{ route('comment.like', $comment) }}">
                {{-- {{ $comment->likedBy }} --}}
                @if ($comment->likedByUser())
                    <i class="fa-solid fa-thumbs-up"></i>
                @else
                    <i class="fa-regular fa-thumbs-up"></i>
                @endif
            </a> 
            {{ $comment->likes->count() }} 
        </span>

        <span class="d-inline-block m-2">
            <a href="{{ route('comment.reply', $comment) }}">
                <i class="fa-solid fa-reply"></i>
            </a>
            {{ $comment->replies->count() }}
        </span>
    </div>
    {{-- likes / shares / replies --}}

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