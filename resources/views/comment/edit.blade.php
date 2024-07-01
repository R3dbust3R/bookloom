<x-layout>

    <div class="container">

        {{-- comment form --}}
        <form action="{{ route('comment.update', $comment) }}" method="POST" class="my-5">
            <h4 class="text-center mb-4">Edit comment</h4>

            {{-- alerts --}}
            @session('comment_success')
            <div class="alert alert-success"> {{ session('comment_success') }} </div>
            @endsession

            @session('comment_error')
            <div class="alert alert-danger"> {{ session('comment_error') }} </div>
            @endsession
            {{-- alerts --}}
            
            @csrf
            @method('PUT')

            <textarea name="comment" rows="12" class="form-control rounded-4">{{ old('comment', $comment->comment) }}</textarea>
            @error('comment')
                <p class="text-danger"> {{ $message }} </p>
            @enderror
            <input type="submit" value="Update" class="btn btn-primary px-4 mt-3 rounded-pill">
        </form>
        {{-- comment form --}}

    </div>

</x-layout>