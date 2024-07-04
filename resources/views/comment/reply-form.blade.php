<x-layout>

    <div class="container">

        {{-- comment reply form --}}
        <form action="{{ route('comment.reply-store') }}" method="POST" class="my-5">
            <h4 class="text-center mb-4">Reply to comment</h4>
            <p class="text-muted">
                {{ $comment->comment }}
            </p>

            {{-- alerts --}}
            @session('comment_success')
            <div class="alert alert-success"> {{ session('comment_success') }} </div>
            @endsession

            @session('comment_error')
            <div class="alert alert-danger"> {{ session('comment_error') }} </div>
            @endsession
            {{-- alerts --}}
            
            @csrf

            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <input type="hidden" name="book_id" value="{{ $comment->book_id }}">

            <textarea name="reply" rows="8" placeholder="Type a reply" class="form-control rounded-4">{{ old('reply') }}</textarea>
            @error('reply')
                <p class="text-danger"> {{ $message }} </p>
            @enderror
            <input type="submit" value="Reply" class="btn btn-primary px-4 mt-3 rounded-pill">
        </form>
        {{-- comment reply form --}}

    </div>

</x-layout>