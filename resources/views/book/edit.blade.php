<x-layout>

{{-- book-edit form --}}
<section class="login py-5">
    <div class="container">
        <h2 class="text-center text-capitalize mb-4">Edit {{ $book->title }}</h2>

        <form 
            enctype="multipart/form-data" 
            action="{{ route('book.update', $book) }}" 
            method="POST" 
            class="border bg-light rounded-4 m-auto w-75 p-5">
            @csrf
            @method('PUT')

            {{-- alert messages --}}
            @session('error')
                <div class="alert alert-danger mb-3">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endsession

            @session('success')
                <div class="alert alert-success mb-3">
                    <i class="fa-regular fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endsession
            {{-- alert messages --}}

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <input 
                            type="text" 
                            class="form-control rounded-pill" 
                            placeholder="Book title (Required)" 
                            value="{{ old('title', $book->title) }}"
                            name="title">
                        @error('title') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <input 
                            type="text" 
                            class="form-control rounded-pill" 
                            placeholder="Book author (Required)" 
                            value="{{ old('author', $book->author) }}"
                            name="author">
                        @error('author') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <select 
                            class="form-control rounded-pill"
                            name="language_id">
                            <option value="0">Select book language</option>
                            @foreach ($languages as $language)
                                <option class="text-capitalize" {{ ($book->language_id == $language->id) ? 'SELECTED' : '' }}  value="{{ $language->id }}"> {{ $language->name }} </option>
                            @endforeach
                        </select>
                        @error('language_id') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <select 
                            class="form-control rounded-pill"
                            name="genre_id">
                            <option value="0">Select book category</option>
                            @foreach ($genres as $genre)
                                <option class="text-capitalize" {{ ($book->genre_id == $genre->id) ? 'SELECTED' : '' }} value="{{ $genre->id }}"> {{ $genre->name }} </option>
                            @endforeach
                        </select>
                        @error('genre_id') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group mb-3">
                        <input 
                            type="number" 
                            class="form-control rounded-pill"
                            placeholder="Number of pages"
                            value="{{ old('page_count', $book->page_count) }}"
                            name="page_count">
                        @error('page_count') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <textarea 
                                class="form-control rounded-4"
                                placeholder="Book description (Optional)"
                                name="description"
                                class="" style="min-height: 360px">{{ old('description', $book->description) }}</textarea>
                            @error('description') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label for="cover" class="text-muted mb-2">Book cover (Optional)</label>
                            <input 
                                type="file" 
                                class="form-control rounded-pill"
                                name="cover" id="cover">
                            @error('cover') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <img 
                            src="{{ asset('storage/' . ($book->cover ? $book->cover : 'books/default.png')) }}" 
                            alt="{{ $book->title }}\'s cover image"
                            class="d-block w-100 border rounded-4 c-pointer"
                            onclick="document.getElementById('cover').click()">
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary rounded-pill px-4" value="Update">
                <a href="{{ route('user.profile') }}" class="btn bg-white border rounded-pill px-4">Cancel</a>
            </div>

        </form>
    </div>
</section>
{{-- book-edit form --}}



</x-layout>