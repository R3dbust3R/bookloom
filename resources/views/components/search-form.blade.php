<div class="search-form" id="search-form">
    <div class="overlay-close" id="overlay-close"></div>
    <form action="{{ route('home.search') }}" method="GET" class="bg-white p-5 rounded-4">
        <div class="input-group">
            <input type="text" class="form-control form-lg px-4" placeholder="Search for books" name="query">
            <input type="submit" class="btn btn-dark btn-lg" value="Serach">
        </div>
    </form>
</div>