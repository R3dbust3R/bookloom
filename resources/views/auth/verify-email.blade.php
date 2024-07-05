<x-layout>


    <div class="container py-5 text-center">

        {{-- alert --}}
        @session('message')
            <div class="alert alert-success">
                <i class="fa-solid fa-check-circle"></i> {{ session('message') }}
            </div>
        @endsession
        {{-- alert --}}

        <h2 class="mb-3">Hello {{ Auth::user()->name }}</h2>
        <img 
            src="{{ asset('storage/ui/email-verification.png') }}" 
            alt="just an image" 
            class="d-block my-3 mx-auto"
            style="width: 120px;">
        <p class="fw-light text-muted fs-5 text-capitalize mb-0">
            Before you gain full access to your account, <br> 
            Please verify your Email address by checking your inbox.
        </p>
        <hr class="w-75 my-4 m-auto">
        <p class="text-muted fw-light fs-5">
            Didn't get the email?
            <form action="{{ route('verification.send') }}" method="POST" class="d-inline-block">
                @csrf <input type="submit" value="Resend" class="btn btn-primary px-5 py-2">
            </form>
        </p>
    </div>


</x-layout>