<x-layout>

<div class="container text-center rounded-4 pb-5 my-4">

    <img 
        src="{{ asset('storage/ui/403.png') }}" 
        alt="Page not found"
        class="w-50">

    <h2 class="my-3">You Do Not Have Access to This Page!</h2>

    <a href="{{ route('home.index') }}" class="btn btn-outline-primary px-5 py-2">
        <i class="fa-solid fa-arrow-left-long d-inline-block me-2"></i> Go Home
    </a>

</div>

</x-layout>