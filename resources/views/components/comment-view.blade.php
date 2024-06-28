@props(['comment'])

<div class="comment-container rounded-4 mb-4 p-5" style="background: #00000005">

    <h6>
        <a href="{{ route('user.show', $comment->user) }}">
            {{ $comment->user->name }}
        </a>
    </h6>
    <div class="meta text-muted fs-6">
        Published: {{ $comment->created_at->DiffForHumans() }}
    </div>
    <p class="lead m-0">
        {{ $comment->comment }}
    </p>

</div>